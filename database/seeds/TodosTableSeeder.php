<?php

use Illuminate\Database\Seeder;
use App\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $todos = [
        //     [
        //         'user_id' => 1,
        //         'name' => 'finish task 1',
        //         'description' => 'finish task 1 before 6pm',
        //         'is_completed' => 0,
        //         'except_finish_time' => new DateTime,
        //         'created_at' => new DateTime,
        //         'updated_at' => null,
        //     ],
        //     [
        //         'user_id' => 1,
        //         'name' => 'finish task 2',
        //         'description' => 'finish task 2 before 6pm',
        //         'is_completed' => 0,
        //         'except_finish_time' => new DateTime,
        //         'created_at' => new DateTime,
        //         'updated_at' => null,
        //     ]
        // ];

        date_default_timezone_set('Pacific/Auckland'); 

        for($i = 0; $i <= 59; $i++) {
            $todo = new Todo;
            $todo->user_id = 1;
            $todo->name = 'name ' . $i;
            $todo->description = 'finish task ' . $i;
            $todo->is_completed = 1;
            $todo->except_finish_time = date_create('+1 hour');
            $todo->finish_time = date_create('-' . random_int(0, 60) . ' minute');
            $todo->created_at = new DateTime;

            $todo->save();
        }

        //DB::table('Todos')->insert($todos);
    }
}
