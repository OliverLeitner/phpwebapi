<?php

namespace Base;

use \Productlines as ChildProductlines;
use \ProductlinesQuery as ChildProductlinesQuery;
use \Exception;
use \PDO;
use Map\ProductlinesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'productlines' table.
 *
 *
 *
 * @method     ChildProductlinesQuery orderByProductline($order = Criteria::ASC) Order by the productLine column
 * @method     ChildProductlinesQuery orderByTextdescription($order = Criteria::ASC) Order by the textDescription column
 * @method     ChildProductlinesQuery orderByHtmldescription($order = Criteria::ASC) Order by the htmlDescription column
 * @method     ChildProductlinesQuery orderByImage($order = Criteria::ASC) Order by the image column
 *
 * @method     ChildProductlinesQuery groupByProductline() Group by the productLine column
 * @method     ChildProductlinesQuery groupByTextdescription() Group by the textDescription column
 * @method     ChildProductlinesQuery groupByHtmldescription() Group by the htmlDescription column
 * @method     ChildProductlinesQuery groupByImage() Group by the image column
 *
 * @method     ChildProductlinesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductlinesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductlinesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductlinesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductlinesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductlinesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductlinesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildProductlinesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildProductlinesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildProductlinesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildProductlinesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildProductlinesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildProductlinesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductlines|null findOne(ConnectionInterface $con = null) Return the first ChildProductlines matching the query
 * @method     ChildProductlines findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductlines matching the query, or a new ChildProductlines object populated from the query conditions when no match is found
 *
 * @method     ChildProductlines|null findOneByProductline(string $productLine) Return the first ChildProductlines filtered by the productLine column
 * @method     ChildProductlines|null findOneByTextdescription(string $textDescription) Return the first ChildProductlines filtered by the textDescription column
 * @method     ChildProductlines|null findOneByHtmldescription(string $htmlDescription) Return the first ChildProductlines filtered by the htmlDescription column
 * @method     ChildProductlines|null findOneByImage(string $image) Return the first ChildProductlines filtered by the image column *

 * @method     ChildProductlines requirePk($key, ConnectionInterface $con = null) Return the ChildProductlines by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductlines requireOne(ConnectionInterface $con = null) Return the first ChildProductlines matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductlines requireOneByProductline(string $productLine) Return the first ChildProductlines filtered by the productLine column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductlines requireOneByTextdescription(string $textDescription) Return the first ChildProductlines filtered by the textDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductlines requireOneByHtmldescription(string $htmlDescription) Return the first ChildProductlines filtered by the htmlDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductlines requireOneByImage(string $image) Return the first ChildProductlines filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductlines[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductlines objects based on current ModelCriteria
 * @method     ChildProductlines[]|ObjectCollection findByProductline(string $productLine) Return ChildProductlines objects filtered by the productLine column
 * @method     ChildProductlines[]|ObjectCollection findByTextdescription(string $textDescription) Return ChildProductlines objects filtered by the textDescription column
 * @method     ChildProductlines[]|ObjectCollection findByHtmldescription(string $htmlDescription) Return ChildProductlines objects filtered by the htmlDescription column
 * @method     ChildProductlines[]|ObjectCollection findByImage(string $image) Return ChildProductlines objects filtered by the image column
 * @method     ChildProductlines[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductlinesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductlinesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Productlines', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductlinesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductlinesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductlinesQuery) {
            return $criteria;
        }
        $query = new ChildProductlinesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProductlines|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductlinesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductlinesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductlines A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT productLine, textDescription, htmlDescription, image FROM productlines WHERE productLine = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProductlines $obj */
            $obj = new ChildProductlines();
            $obj->hydrate($row);
            ProductlinesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProductlines|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductlinesTableMap::COL_PRODUCTLINE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductlinesTableMap::COL_PRODUCTLINE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the productLine column
     *
     * Example usage:
     * <code>
     * $query->filterByProductline('fooValue');   // WHERE productLine = 'fooValue'
     * $query->filterByProductline('%fooValue%', Criteria::LIKE); // WHERE productLine LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productline The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByProductline($productline = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productline)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductlinesTableMap::COL_PRODUCTLINE, $productline, $comparison);
    }

    /**
     * Filter the query on the textDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByTextdescription('fooValue');   // WHERE textDescription = 'fooValue'
     * $query->filterByTextdescription('%fooValue%', Criteria::LIKE); // WHERE textDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $textdescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByTextdescription($textdescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($textdescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductlinesTableMap::COL_TEXTDESCRIPTION, $textdescription, $comparison);
    }

    /**
     * Filter the query on the htmlDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByHtmldescription('fooValue');   // WHERE htmlDescription = 'fooValue'
     * $query->filterByHtmldescription('%fooValue%', Criteria::LIKE); // WHERE htmlDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $htmldescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByHtmldescription($htmldescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($htmldescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductlinesTableMap::COL_HTMLDESCRIPTION, $htmldescription, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * @param     mixed $image The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {

        return $this->addUsingAlias(ProductlinesTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query by a related \Products object
     *
     * @param \Products|ObjectCollection $products the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductlinesQuery The current query, for fluid interface
     */
    public function filterByProducts($products, $comparison = null)
    {
        if ($products instanceof \Products) {
            return $this
                ->addUsingAlias(ProductlinesTableMap::COL_PRODUCTLINE, $products->getProductline(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            return $this
                ->useProductsQuery()
                ->filterByPrimaryKeys($products->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function joinProducts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\ProductsQuery):\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductlines $productlines Object to remove from the list of results
     *
     * @return $this|ChildProductlinesQuery The current query, for fluid interface
     */
    public function prune($productlines = null)
    {
        if ($productlines) {
            $this->addUsingAlias(ProductlinesTableMap::COL_PRODUCTLINE, $productlines->getProductline(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the productlines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductlinesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductlinesTableMap::clearInstancePool();
            ProductlinesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductlinesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductlinesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductlinesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductlinesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductlinesQuery
