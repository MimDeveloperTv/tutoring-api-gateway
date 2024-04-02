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
        $this->group = $this->getGroup();
        $this->url = "{$basePath}/{$this->group}";
    }

    public function getGroup(): string
    {
        /* @var $user User */
        $user = auth()->user();
        if(!empty($user)){
            $userAccessToken = $user->token();
            $group = $userAccessToken->client()->first('name')->name;
            return str($group)->lower()->value();
        }
        return '';
    }

    public function headers(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-USER-ID' => auth()->user()->getAuthIdentifier(),
            'X-USER-TYPE' => str($this->group)->upper()->value(),
            'X-CLIENT-CREDENTIAL' => config('services.credentials.client'),
        ];

    }

    /**  @throws DomainException */
    public function get($path, $data = null)
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
    public function post($path, $data, ?array $mergedHeaders = [])
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
    public function postWithFile($path, $data, $file = null): mixed
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
    public function patch($path, $data)
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
    public function put($path, $data)
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
    public function delete($path, $data = null)
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
