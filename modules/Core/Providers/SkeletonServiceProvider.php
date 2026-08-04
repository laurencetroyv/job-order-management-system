<?php

namespace Modules\Core\Providers;

use Route;
use ReflectionClass;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\Self_;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * The directory of where the module's ServiceProvider is located.
     */
    protected string $dir;

    /**
     * The namespace of the module's ServiceProvider.
     */
    protected string $namespace;

    /**
     * The tag to identify the module
     */
    protected string $tag;

    public function __construct($app)
    {
        parent::__construct($app);

        $reflection = new ReflectionClass(static::class);

        $this->dir = dirname($reflection->getFileName());
        $this->namespace = $reflection->getNamespaceName();

        // -- Get Tag Name
        $name = basename(dirname($this->dir));
        $this->tag = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));
    }

    public function register(): void
    {
        $this->app->singleton(Self_::class, function () {
            return new Self_;
        });
    }

    public function boot(): void
    {
        $this->loadMigrations();
        $this->loadViews();
        $this->loadRoutes();
    }

    protected function loadMigrations(): void
    {
        $path = $this->dir.'/../Database/Migrations';

        if (! is_dir($path)) {
            return;
        }

        $this->loadMigrationsFrom($path);
    }

    protected function loadViews(): void
    {
        $path = $this->dir.'/../Resources/Views';

        if (! is_dir($path)) {
            return;
        }

        $this->loadViewsFrom(
            path: $path,
            namespace: $this->tag
        );
    }

    protected function loadRoutes(): void
    {
        $webPath = $this->dir."/../Routes/$this->tag-web.php";
        $apiPath = $this->dir."/../Routes/$this->tag-api.php";

        if (file_exists($webPath)) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath)) {
            Route::prefix('api')->middleware('web')->group($apiPath);
        }
    }
}
