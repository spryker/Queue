<?php
namespace SprykerFeature\Shared\Library\Storage\Adapter\Solr\Solarium\QueryType\Admin;

use Solarium\Core\Query\Query as BaseQuery;

/**
 * Class Query
 * @package SprykerFeature\Shared\Library\Storage\Adapter\Solr\Solarium\QueryType\Admin
 */
class Query extends BaseQuery
{
    const QUERY_ADMIN = 'admin';

    /**
     * Default options for the system query type.
     *
     * @var array
     */
    protected $options = array(
        'resultclass' => 'SprykerFeature\Shared\Library\Storage\Adapter\Solr\Solarium\QueryType\Admin\Result',
        'handler' => 'cores/',
    );

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return self::QUERY_ADMIN;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestBuilder()
    {
        return new RequestBuilder();
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseParser()
    {
        return new ResponseParser();
    }
}