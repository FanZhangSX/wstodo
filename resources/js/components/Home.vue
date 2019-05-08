    <template>
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <canvas id="BurnChart"></canvas>
                        </div>
                        <div class="row">
                            <p>Todo List</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>Finish Time</th>
                                        <th>Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(todo, index) in todos" v-bind:key="index">
                                        <td>{{ todo.name }}</td>
                                        <td>{{ todo.user_id }}</td>
                                        <td>{{ todo.description }}</td>
                                        <td>{{ todo.finish_time }}</td>
                                        <td>{{ todo.is_completed ? 'true' : 'false' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="isLoggedIn">
                            <router-link to="/TodoAdd" class="btn btn-primary" tag="button"> New Task </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
        import {Line} from "vue-chartjs";
        
        export default {
            extends: Line,
            data() {
                var arr = []
                for(var i=0; i<60; i++) {
                    arr.push(i)
                }

                return {
                    isLoggedIn: localStorage.getItem('wstodo.jwt') != null,
                    chartPoint: [],
                    todos: [],
                    chartData: {
                        type: 'line',
                        data: {
                            labels: arr,
                            datasets: [
                                {
                                    label: 'incompleted task in the last hour',
                                    data: this.chartPoint,
                                    backgroundColor: '#f87979',
                                    borderColor: '#36495d',
                                    borderWidth: 3
                                }
                            ],
                        },
                        options: {
                            responsive: true,
                            lineTension: 1,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        padding: 25,
                                    }
                                }]
                            }
                        }
                    },
                }
            },

            watch: {
                chartPoint() {
                    this.myChart.data.datasets.forEach((dataset, index)=> {
                        dataset.data = this.chartPoint
                    })
                    this.myChart.update()
                    this.updateChart()
                },

            },

            mounted(){
                this.fillChartData();
                this.chartData.data.datasets.forEach((dataset, index) => {
                    dataset.data = this.chartPoint
                });
                this.createChart('BurnChart', this.chartData);
                    
                this.timer = setInterval(this.fillChartData, 60000);
            },

            methods: {
                handleSubmit(e) {
                    console.log(e)
                },

                fillChartData() {
                    axios.get("api/todos").then(response => this.todos = response.data).then(data=> {
                        let dateNow = new Date();
                        let chartPoint = {};
                        for(let i=0; i<=59; i++) {
                            chartPoint[i] = 0;
                        }
                        this.todos.forEach(element => {
                            if(element.finish_time == null)
                            {
                                for(var i = 0; i < 60; i++) {
                                    chartPoint[i]++;
                                }
                                return;
                            }
                            else {
                                var finish_time = new Date(element.finish_time)
                                var timeDiff = Math.round((dateNow.getTime() - finish_time.getTime())/(1000 * 60))
                                if(timeDiff <= 60 && timeDiff > 0) {
                                    for(var i = 0; i < timeDiff; i++) {
                                        chartPoint[i] ++;
                                    }
                                }
                            }
                        });
                        this.chartPoint = Object.values(chartPoint)
                    })

                    
                },
                createChart(chartId, chartData) {
                    const ctx = document.getElementById(chartId);
                    this.myChart = new Chart(ctx, {
                        type: chartData.type,
                        data: chartData.data,
                        options: chartData.options,
                    })
                },

                updateChart() {
                    this.myChart.update()
                },

                
            },
        }
    </script>

    <style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    </style>