<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
        });

        // Generate usernames for existing users
        \DB::table('users')->whereNull('username')->orWhere('username', '')->get()->each(function ($user) {
            $username = strtolower(str_replace(' ', '', $user->name));
            \DB::table('users')->where('id', $user->id)->update([
                'username' => $username . $user->id
            ]);
        });

        // Make username unique after populating
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
}
