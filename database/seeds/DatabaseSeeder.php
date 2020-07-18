<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('roles')->insert([
            ['name'=>'Administrator'], ['name'=>'Manager'], ['name'=>'Employee'], ['Unassigned']
        ]);

        DB::table('department_names')->insert([
            ['name'=>'Gynecology', 'user_id'=>rand(1,5)],
            ['name'=>'General practice', 'user_id'=>rand(1,5)],
            ['name'=>'Administration', 'user_id'=>rand(1,5)],
            ['name'=>'Cardiology', 'user_id'=>rand(1,5)],
            ['name'=>'Neurology', 'user_id'=>rand(1,5)],
            ['name'=>'Emergency', 'user_id'=>rand(1,5)]
        ]);

        factory(App\User::class, 5)->create()
            ->each(function ($u){
                $u->clinic()->saveMany(factory(App\Clinic::class, rand(0,2))->make())
                ->each(function ($c){
                    $c->departments()->saveMany(factory(App\Department::class, rand(1,4))->make())
                    ->each(function ($d){
                        $d->employees()->saveMany(factory(App\Employee::class, rand(3,10))->make())
                        ->each(function ($e) {
                            $e->fields()->saveMany(factory(App\Field::class, rand(3, 10))->make())
                            ->each(function ($f){
                                $f->record()->saveMany(factory(App\Record::class, 1)->make());
                            });
                        });
                    });
                });
            });


    }
}
