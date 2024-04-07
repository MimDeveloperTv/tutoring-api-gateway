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
        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->get($endpoint, $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function post($path, $data = [], ?array $mergedHeaders = [])
    {
        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders(array_merge($this->headers(), $mergedHeaders))
            ->post($endpoint, $data);

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

        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders($headers);

        if (method_exists($file, 'getClientOriginalName')) {
            $client->attach('file', fopen($file, 'r'), $file->getClientOriginalName());
        }

        $client = $client->post($endpoint, $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function patch($path, $data = [])
    {
        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->patch($endpoint, $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function put($path, $data = [])
    {
        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->put($endpoint, $data);

        $response = $client->json();

        if ($client->failed()) {
            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    public function delete($path, $data = [])
    {
        $endpoint = "{$this->url}/{$path}";
        $endpoint = $this->checkDebugMode($endpoint);

        $client = Http::acceptJson()
            ->withHeaders($this->headers())
            ->delete($endpoint, $data);

        $response = $client->json();

        if ($client->failed()) {

            if(!empty(data_get($response,'errors'))){
                $response = data_get($response,'errors');
            }

            $this->exception($client->status(), $response, $client->toException());
        }

        return $response;
    }

    /**  @throws DomainException */
    private function exception($status, $errors, \Throwable $exception)
    {
        throw new DomainException($status, $errors, previous: $exception);
    }

    private function checkDebugMode($endpoint)
    {
        $Debugging = !empty(request()->query('XDEBUG_SESSION'));
        return $Debugging ?  ($endpoint . "?XDEBUG_SESSION=true")  : $endpoint;
    }

}
