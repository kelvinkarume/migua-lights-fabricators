use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

public function boot(): void
{
    parent::boot();

    // Register custom route middleware
    Route::aliasMiddleware('role', RoleMiddleware::class);
}