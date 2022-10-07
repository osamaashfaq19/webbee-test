<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

    ** movie table : id.,name, date_of_release,duration, created_at,updated_at ** 
    ** showrooms : id, name,created_at,updated_at**
    ** pricing : id, type='vip','couple', premium_percentage, price, created_at,updated_at **
    ** seats : id, code, price_id,location, created_at, updated_at
    ** shows : id, movie_id,showroom_id, status, created_at,updated_at**
    ** show_seats : id, seat_id, show_id **  

     ** Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {

        Schema::create('movies', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date_of_release');
            $table->timestamps();
        });

        Schema::create('showrooms', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('seat_types', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->double('premium_percentage'); 
            $table->timestamps();
        });

        Schema::create('seats', function($table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('seat_type_id')->unsigned();
            $table->foreign('seat_type_id')->references('id')->on('seat_types')->onDelete('cascade');
            $table->string('location');
            $table->timestamps();
        });

        Schema::create('shows', function($table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');            
            $table->integer('showroom_id')->unsigned();
            $table->foreign('showroom_id')->references('id')->on('showrooms')->onDelete('cascade');            
            $table->dateTime('start');
            $table->dateTime('end');
            $table->double('price');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('show_seats', function($table) {
            $table->increments('id');
            $table->integer('show_id')->unsigned();
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');            
            $table->integer('seat_id');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');   
            $table->double('price');
            $table->tinyInteger('status');
            $table->timestamps();
        });


        // throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
