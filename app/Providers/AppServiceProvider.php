<?php

namespace App\Providers;

use DateTimeInterface;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! env('LOG_QUERY_ENABLED', true)) {
            return;
        }

        DB::listen(function (QueryExecuted $query): void {
            $bindings = $query->connection->prepareBindings($query->bindings);

            $sql = Str::replaceArray('?', array_map(
                fn ($binding) => $this->quoteBinding($binding),
                $bindings
            ), $query->sql);

            // Log::channel('single')->debug($sql, [
            //     'connection' => $query->connectionName,
            //     'time_ms' => $query->time,
            //     'sql' => $query->sql,
            //     'bindings' => $bindings,
            // ]);
            Log::channel('single')->debug($sql);
        });
    }

    private function quoteBinding(mixed $binding): string
    {
        if ($binding === null) {
            return 'null';
        }

        if ($binding instanceof DateTimeInterface) {
            return "'{$binding->format('Y-m-d H:i:s')}'";
        }

        if (is_bool($binding)) {
            return $binding ? '1' : '0';
        }

        if (is_int($binding) || is_float($binding)) {
            return (string) $binding;
        }

        return "'".str_replace("'", "''", (string) $binding)."'";
    }
}
