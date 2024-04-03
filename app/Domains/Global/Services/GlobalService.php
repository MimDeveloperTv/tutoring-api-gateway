<?php

namespace App\Domains\Global\Services;

use App\Domains\Global\Exceptions\DomainException;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class GlobalService
{
    private string $url;
    private string $group;

    /**
     * WalletService constructor.
     */
    public function __construct($domain)
    {
        $basePath = config("services.domains.{$domain}");
        $this->url = "{$basePath}";
    }

    public function headers(): array
    {
        $user = auth()->user();
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-USER-ID' => !empty($user) ? $user->getAuthIdentifier() : null,
            'X-CLIENT-CREDENTIAL' => config('services.credentials.client'),
            'DOMAIN' => request()->header('domain') ?? null,
        ];

    }

    /**  @throws DomainException */
    public function get($path, $data = [])
    {
        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->get("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function post($path, $data = [], ?array $mergedHeaders = [])
    {
        $client = Http::acceptJson()
            ->withHeaders(array_merge($this->headers(), $mergedHeaders))
            ->post("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function postWithFile($path, $data = [], $file = null): mixed
    {
        $headers = $this->headers();
        unset($headers['Content-Type']);

        $client = Http::acceptJson()
            ->withHeaders($headers);

        if (method_exists($file, 'getClientOriginalName')) {
            $client->attach('file', fopen($file, 'r'), $file->getClientOriginalName());
        }

        $client = $client->post("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function patch($path, $data = [])
    {
        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->patch("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function put($path, $data = [])
    {
        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->put("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function delete($path, $data = [])
    {
        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->delete("{$this->url}/{$path}", $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    private function exception($status, $errors, \Throwable $exception)
    {
        throw new DomainException($status, $errors, previous: $exception);
    }

}
