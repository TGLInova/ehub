<?php

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Http\Request;


class Workspace
{
    public readonly string $host;

    public function __construct(public readonly Request $request)
    {
        $this->host = parse_url(config('app.url'), PHP_URL_HOST);
    }

    public function slug(): ?string
    {
        $slug = str($this->request->host())->before($this->host)->before('.')->toString();

        return blank($slug) ? null : $slug;
    }

    public function domain()
    {
        return $this->slug() . '.' . $this->host;
    }

    public function empresa(): ?Empresa
    {
        $slug = $this->slug();

        if ($slug === null) {
            return null;
        }

        return Empresa::where('slug', $slug)->firstOrFail();
    }
}
