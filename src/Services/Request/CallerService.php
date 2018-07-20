<?php

namespace App\Services\Request;

use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTParam;
use App\Services\Parameters\WsParameters;
use App\Services\Parameters\WsTypeContext;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Unirest;

class CallerService
{
    private $cache_key_admin = 'dfc2.api.contexte.admin';

    /**
     * @var string
     */
    protected $module = '';
    /**
     * @var string
     */
    protected $context = 'pijDSCntxClient={"ProDataSet":{}}';
    /**
     * @var string
     */
    protected $paramsAppel = NULL;
    /**
     * @var string
     */
    protected $critsSelect = NULL;
    /**
     * @var string
     */
    protected $origin = '';
    /**
     * @var string
     */
    protected $modif = '';
    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var array
     */
    protected $filter = array();

    /**
     * @var array
     */
    protected $headers = array(
        'Accept' => WsParameters::ACCEPT,
        'Content-type' => WsParameters::CONTENT_TYPE,
        'Origin' => WsParameters::ORIGIN,
        'Referer' => WsParameters::REFERER);

    /**
     * @var FilesystemCache
     */
    protected $cache = NULL;

    /**
     * CallerService constructor.
     */
    public function __construct()
    {
        $this->setParamsAppel(new TTParam());
        $this->setCritsSelect(new TTParam());
    }


    /**
     * @param FilesystemCache $cache
     * @return CallerService
     */
    public function setCache(FilesystemCache $cache)
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * @return string
     */
    private function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     * @return CallerService
     */
    public function setModule(string $module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @return string
     * @throws
     */
    private function getContext(): string
    {
        if($this->cache->has($this->cache_key_admin)) {
            $data = $this->cache->get($this->cache_key_admin);
            $contexte = new CntxAdmin();
            if($contexte->__parse($data)) {
                if($contexte->isValid()) {
                    $this->context = 'pijDSCntxClient=' . $contexte->__toString();
                    return $this->context;
                }
            }
        }
        return $this->context;
    }

    /**
     * @param string $context
     * @return CallerService
     */
    public function setContext(string $context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return string
     */
    private function getParamsAppel(): string
    {
        if($this->paramsAppel->countItems() > 0) {
            return 'pijDSParamAppel={"ProDataSet":{"ttParam":' . $this->paramsAppel->__toString() . '}}';
        }
        return 'pijDSParamAppel={"ProDataSet":{}}';
    }

    /**
     * @param TTParam $paramsAppel
     * @return CallerService
     */
    public function setParamsAppel(TTParam $paramsAppel)
    {
        $this->paramsAppel = $paramsAppel;
        return $this;
    }

    /**
     * @return string
     */
    private function getCritsSelect(): string
    {
        $filters = $this->getFilter();

        if(!is_null($filters) && count($filters) > 0) {
            foreach ($filters as $param) {
                $this->critsSelect->addItem($param);
            }
        }

        if($this->critsSelect->countItems() > 0) {
            return 'pijDSCritSel={"ProDataSet":{"ttParam":' . $this->critsSelect->__toString() . '}}';
        }
        else {
            return 'pijDSCritSel={"ProDataSet":{}}';
        }
    }

    /**
     * @param TTParam $critsSelect
     * @return CallerService
     */
    public function setCritsSelect(TTParam $critsSelect)
    {
        $this->critsSelect = $critsSelect;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }

    /**
     * @param array $filter
     * @return CallerService
     */
    public function setFilter(array $filter)
    {
        $this->filter = $filter;
        return $this;
    }


    /**
     * @return string
     */
    private function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     * @return CallerService
     */
    public function setOrigin(string $origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return string
     */
    private function getModif(): string
    {
        return $this->modif;
    }

    /**
     * @param string $modif
     * @return CallerService
     */
    public function setModif(string $modif)
    {
        $this->modif = $modif;
        return $this;
    }

    /**
     * @return array
     */
    private function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return CallerService
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return string
     */
    private function getBaseUrl() {
        return 'http://www.dfc2.fr' . WsParameters::URL_SUFFIX;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    private function setUrl()
    {
        $this->url = $this->getBaseUrl(). '?' . 'picModule=' . $this->getModule();

        switch($this->getContext()) {
            case WsTypeContext::CONTEXT_NONE:
                break;
            default:
                $this->url .= '&' . $this->getContext();
                break;
        }

        if (!empty($this->getParamsAppel())){
            $this->url .= '&' . $this->getParamsAppel();
        }

        $critsSelect = $this->getCritsSelect();
        if (!empty($critsSelect)){
            $this->url .= '&' . $critsSelect;
        }

        return $this->url;
    }

    /**
     * @return string
     */
    private function getBody(): string
    {
        return '{ "request": { "pijDSOrig": '.$this->getOrigin().', "pijDSModif": '.$this->getModif().'}}';
    }


    /**
     * Appel GET
     * @return Unirest\Response
     */
    public function get() {
        $this->setUrl();
        $response = Unirest\Request::get($this->getUrl(), $this->getHeaders(), null);
        return $response;
    }

    /**
     * Appel PUT
     * @return Unirest\Response
     */
    public function put() {
        $this->setUrl();
        $response = Unirest\Request::put($this->getUrl(), $this->getHeaders(), $this->getBody());
        return $response;
    }
}