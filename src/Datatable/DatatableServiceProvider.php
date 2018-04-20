<?php

namespace Sztyup\Datatable;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class DatatableServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(BladeCompiler $blade)
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'datatables');

        $blade->directive("datatablejs", function ($expression) {
            return "<?php echo \$__env->make(" .
                "'datatables::datatable.datatable_js'," .
                "array_except(get_defined_vars() + ['datatable' => \$dataTable], array('__data', '__path'))" .
                ")->render(); ?>";
        });

        $blade->directive("datatable", function ($expression) {
            return "<?php echo \$__env->make(" .
                "'datatables::datatable.datatable_html'," .
                "array_except(get_defined_vars() + ['datatable' => \$dataTable], array('__data', '__path'))" .
                ")->render(); ?>";
        });
    }
}
