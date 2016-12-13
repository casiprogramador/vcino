<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::extend(function($value) {
			return preg_replace('/\@var(.+)/', '<?php ${1}; ?>', $value);
		});
		
		Blade::directive('mes', function($expression) {
			if($expression == '1' ){
				$mes_literal = 'Enero';
			}else{
				$mes_literal = 'Otro';
			}
            return "<?php echo '".$mes_literal."'; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
