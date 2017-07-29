<?php

namespace App;

use InvalidArgumentException;

class Site
{

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string|null
     */
    private $domain;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param string $slug
     * @param array $values
     * @return Site
     */
    public static function create(string $slug, array $values): self
    {
        $site = new self($slug);
        $site->exchangeArray($values);

        return $site;
    }

    /**
     * Site constructor.
     *
     * @param string $slug
     */
    public function __construct(string $slug)
    {
        if (empty($slug)) {
            throw new InvalidArgumentException('Expecting a non-empty slug');
        }

        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param mixed $domain
     * @return $this
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return (string) $this->domain;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function exchangeArray(array $values)
    {
        if ($domain = $values['domain'] ?? null) {
            $this->setDomain($domain);
        }

        if ($name = $values['name'] ?? null) {
            $this->setName($name);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'domain' => $this->getDomain(),
            'name' => $this->getName(),
        ];
    }

    /**
     * @return void
     */
    public function save()
    {
        app(SiteRepository::class)->store($this);
    }

    /**
     * @return void
     */
    public function delete()
    {
        app(SiteRepository::class)->remove($this);
    }

}
