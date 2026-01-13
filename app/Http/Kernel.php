<php?
protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\EnsureRole::class,
];
</php