# Uniquely identified models for Laravel 4

_Uniquely_ uses UUIDv4 as primary key for [Laravel 4 Eloquent models](http://laravel.com/docs/eloquent). It automatically generates the UUID when your model is saved. _Uniquely_ overwrites the `save()` method instead of attaching to Eloquent's `creating` event in order to circumvent some problems in combination with unit testing.
    
## Installation

To install _Uniquely_ run

    $ composer require lukaskorl/uniquely
    
You can specify `1.*` to include the most current version including possible future bugfixes.

__Manual installation__

If you choose to install _Uniquely_ manually add the following line to your `composer.json`:

    "require": {
        "lukaskorl/uniquely": "1.*"
    }
    
and run

    $ composer update
   
to install the package.

## Usage

To use a _Uniquely_ model simply extend your model class from `Lukaskorl\Uniquely\Model`.

    <?php
    
    use Lukaskorl\Uniquely\Model;
    
    class User extends Model {
    
    }
    
### Proper database migrations

The `id` field of the corresponding database table for your model should be a 36-char string (i.e. `VARCHAR(36)`). If you are using [Laravel 4 migrations](http://laravel.com/docs/migrations) you will have to set your `id` field like so:

    <?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    
    class CreateUsersTable extends Migration {
    
    	public function up()
    	{
    		Schema::create('users', function(Blueprint $table)
    		{
    			$table->string('id', 36);
    			// ... other columns ...
    			$table->timestamps();
    		});
    
            Schema::table('users', function(Blueprint $table)
            {
                $table->primary('id');
            });
    	}
    
    
    	/**
    	 * Reverse the migrations.
    	 *
    	 * @return void
    	 */
    	public function down()
    	{
    		Schema::drop('users');
    	}
    }

## License

_Uniquely_ is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).