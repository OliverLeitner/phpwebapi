<?php

namespace Base;

use \Products as ChildProducts;
use \ProductsQuery as ChildProductsQuery;
use \Exception;
use \PDO;
use Map\ProductsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'products' table.
 *
 *
 *
 * @method     ChildProductsQuery orderByProductcode($order = Criteria::ASC) Order by the productCode column
 * @method     ChildProductsQuery orderByProductname($order = Criteria::ASC) Order by the productName column
 * @method     ChildProductsQuery orderByProductline($order = Criteria::ASC) Order by the productLine column
 * @method     ChildProductsQuery orderByProductscale($order = Criteria::ASC) Order by the productScale column
 * @method     ChildProductsQuery orderByProductvendor($order = Criteria::ASC) Order by the productVendor column
 * @method     ChildProductsQuery orderByProductdescription($order = Criteria::ASC) Order by the productDescription column
 * @method     ChildProductsQuery orderByQuantityinstock($order = Criteria::ASC) Order by the quantityInStock column
 * @method     ChildProductsQuery orderByBuyprice($order = Criteria::ASC) Order by the buyPrice column
 * @method     ChildProductsQuery orderByMsrp($order = Criteria::ASC) Order by the MSRP column
 *
 * @method     ChildProductsQuery groupByProductcode() Group by the productCode column
 * @method     ChildProductsQuery groupByProductname() Group by the productName column
 * @method     ChildProductsQuery groupByProductline() Group by the productLine column
 * @method     ChildProductsQuery groupByProductscale() Group by the productScale column
 * @method     ChildProductsQuery groupByProductvendor() Group by the productVendor column
 * @method     ChildProductsQuery groupByProductdescription() Group by the productDescription column
 * @method     ChildProductsQuery groupByQuantityinstock() Group by the quantityInStock column
 * @method     ChildProductsQuery groupByBuyprice() Group by the buyPrice column
 * @method     ChildProductsQuery groupByMsrp() Group by the MSRP column
 *
 * @method     ChildProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductsQuery leftJoinProductlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productlines relation
 * @method     ChildProductsQuery rightJoinProductlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productlines relation
 * @method     ChildProductsQuery innerJoinProductlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Productlines relation
 *
 * @method     ChildProductsQuery joinWithProductlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productlines relation
 *
 * @method     ChildProductsQuery leftJoinWithProductlines() Adds a LEFT JOIN clause and with to the query using the Productlines relation
 * @method     ChildProductsQuery rightJoinWithProductlines() Adds a RIGHT JOIN clause and with to the query using the Productlines relation
 * @method     ChildProductsQuery innerJoinWithProductlines() Adds a INNER JOIN clause and with to the query using the Productlines relation
 *
 * @method     ChildProductsQuery leftJoinOrderdetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderdetails relation
 * @method     ChildProductsQuery rightJoinOrderdetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderdetails relation
 * @method     ChildProductsQuery innerJoinOrderdetails($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderdetails relation
 *
 * @method     ChildProductsQuery joinWithOrderdetails($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderdetails relation
 *
 * @method     ChildProductsQuery leftJoinWithOrderdetails() Adds a LEFT JOIN clause and with to the query using the Orderdetails relation
 * @method     ChildProductsQuery rightJoinWithOrderdetails() Adds a RIGHT JOIN clause and with to the query using the Orderdetails relation
 * @method     ChildProductsQuery innerJoinWithOrderdetails() Adds a INNER JOIN clause and with to the query using the Orderdetails relation
 *
 * @method     \ProductlinesQuery|\OrderdetailsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducts|null findOne(ConnectionInterface $con = null) Return the first ChildProducts matching the query
 * @method     ChildProducts findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProducts matching the query, or a new ChildProducts object populated from the query conditions when no match is found
 *
 * @method     ChildProducts|null findOneByProductcode(string $productCode) Return the first ChildProducts filtered by the productCode column
 * @method     ChildProducts|null findOneByProductname(string $productName) Return the first ChildProducts filtered by the productName column
 * @method     ChildProducts|null findOneByProductline(string $productLine) Return the first ChildProducts filtered by the productLine column
 * @method     ChildProducts|null findOneByProductscale(string $productScale) Return the first ChildProducts filtered by the productScale column
 * @method     ChildProducts|null findOneByProductvendor(string $productVendor) Return the first ChildProducts filtered by the productVendor column
 * @method     ChildProducts|null findOneByProductdescription(string $productDescription) Return the first ChildProducts filtered by the productDescription column
 * @method     ChildProducts|null findOneByQuantityinstock(int $quantityInStock) Return the first ChildProducts filtered by the quantityInStock column
 * @method     ChildProducts|null findOneByBuyprice(string $buyPrice) Return the first ChildProducts filtered by the buyPrice column
 * @method     ChildProducts|null findOneByMsrp(string $MSRP) Return the first ChildProducts filtered by the MSRP column *

 * @method     ChildProducts requirePk($key, ConnectionInterface $con = null) Return the ChildProducts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOne(ConnectionInterface $con = null) Return the first ChildProducts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts requireOneByProductcode(string $productCode) Return the first ChildProducts filtered by the productCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductname(string $productName) Return the first ChildProducts filtered by the productName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductline(string $productLine) Return the first ChildProducts filtered by the productLine column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductscale(string $productScale) Return the first ChildProducts filtered by the productScale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductvendor(string $productVendor) Return the first ChildProducts filtered by the productVendor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductdescription(string $productDescription) Return the first ChildProducts filtered by the productDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByQuantityinstock(int $quantityInStock) Return the first ChildProducts filtered by the quantityInStock column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByBuyprice(string $buyPrice) Return the first ChildProducts filtered by the buyPrice column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByMsrp(string $MSRP) Return the first ChildProducts filtered by the MSRP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProducts objects based on current ModelCriteria
 * @method     ChildProducts[]|ObjectCollection findByProductcode(string $productCode) Return ChildProducts objects filtered by the productCode column
 * @method     ChildProducts[]|ObjectCollection findByProductname(string $productName) Return ChildProducts objects filtered by the productName column
 * @method     ChildProducts[]|ObjectCollection findByProductline(string $productLine) Return ChildProducts objects filtered by the productLine column
 * @method     ChildProducts[]|ObjectCollection findByProductscale(string $productScale) Return ChildProducts objects filtered by the productScale column
 * @method     ChildProducts[]|ObjectCollection findByProductvendor(string $productVendor) Return ChildProducts objects filtered by the productVendor column
 * @method     ChildProducts[]|ObjectCollection findByProductdescription(string $productDescription) Return ChildProducts objects filtered by the productDescription column
 * @method     ChildProducts[]|ObjectCollection findByQuantityinstock(int $quantityInStock) Return ChildProducts objects filtered by the quantityInStock column
 * @method     ChildProducts[]|ObjectCollection findByBuyprice(string $buyPrice) Return ChildProducts objects filtered by the buyPrice column
 * @method     ChildProducts[]|ObjectCollection findByMsrp(string $MSRP) Return ChildProducts objects filtered by the MSRP column
 * @method     ChildProducts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Products', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductsQuery) {
            return $criteria;
        }
        $query = new ChildProductsQuery();
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
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProducts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT productCode, productName, productLine, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP FROM products WHERE productCode = :p0';
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
            /** @var ChildProducts $obj */
            $obj = new ChildProducts();
            $obj->hydrate($row);
            ProductsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTCODE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTCODE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the productCode column
     *
     * Example usage:
     * <code>
     * $query->filterByProductcode('fooValue');   // WHERE productCode = 'fooValue'
     * $query->filterByProductcode('%fooValue%', Criteria::LIKE); // WHERE productCode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productcode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductcode($productcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTCODE, $productcode, $comparison);
    }

    /**
     * Filter the query on the productName column
     *
     * Example usage:
     * <code>
     * $query->filterByProductname('fooValue');   // WHERE productName = 'fooValue'
     * $query->filterByProductname('%fooValue%', Criteria::LIKE); // WHERE productName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductname($productname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTNAME, $productname, $comparison);
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
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductline($productline = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productline)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTLINE, $productline, $comparison);
    }

    /**
     * Filter the query on the productScale column
     *
     * Example usage:
     * <code>
     * $query->filterByProductscale('fooValue');   // WHERE productScale = 'fooValue'
     * $query->filterByProductscale('%fooValue%', Criteria::LIKE); // WHERE productScale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productscale The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductscale($productscale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productscale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTSCALE, $productscale, $comparison);
    }

    /**
     * Filter the query on the productVendor column
     *
     * Example usage:
     * <code>
     * $query->filterByProductvendor('fooValue');   // WHERE productVendor = 'fooValue'
     * $query->filterByProductvendor('%fooValue%', Criteria::LIKE); // WHERE productVendor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productvendor The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductvendor($productvendor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productvendor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTVENDOR, $productvendor, $comparison);
    }

    /**
     * Filter the query on the productDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByProductdescription('fooValue');   // WHERE productDescription = 'fooValue'
     * $query->filterByProductdescription('%fooValue%', Criteria::LIKE); // WHERE productDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productdescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductdescription($productdescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productdescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_PRODUCTDESCRIPTION, $productdescription, $comparison);
    }

    /**
     * Filter the query on the quantityInStock column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityinstock(1234); // WHERE quantityInStock = 1234
     * $query->filterByQuantityinstock(array(12, 34)); // WHERE quantityInStock IN (12, 34)
     * $query->filterByQuantityinstock(array('min' => 12)); // WHERE quantityInStock > 12
     * </code>
     *
     * @param     mixed $quantityinstock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByQuantityinstock($quantityinstock = null, $comparison = null)
    {
        if (is_array($quantityinstock)) {
            $useMinMax = false;
            if (isset($quantityinstock['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_QUANTITYINSTOCK, $quantityinstock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantityinstock['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_QUANTITYINSTOCK, $quantityinstock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_QUANTITYINSTOCK, $quantityinstock, $comparison);
    }

    /**
     * Filter the query on the buyPrice column
     *
     * Example usage:
     * <code>
     * $query->filterByBuyprice(1234); // WHERE buyPrice = 1234
     * $query->filterByBuyprice(array(12, 34)); // WHERE buyPrice IN (12, 34)
     * $query->filterByBuyprice(array('min' => 12)); // WHERE buyPrice > 12
     * </code>
     *
     * @param     mixed $buyprice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByBuyprice($buyprice = null, $comparison = null)
    {
        if (is_array($buyprice)) {
            $useMinMax = false;
            if (isset($buyprice['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BUYPRICE, $buyprice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($buyprice['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BUYPRICE, $buyprice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_BUYPRICE, $buyprice, $comparison);
    }

    /**
     * Filter the query on the MSRP column
     *
     * Example usage:
     * <code>
     * $query->filterByMsrp(1234); // WHERE MSRP = 1234
     * $query->filterByMsrp(array(12, 34)); // WHERE MSRP IN (12, 34)
     * $query->filterByMsrp(array('min' => 12)); // WHERE MSRP > 12
     * </code>
     *
     * @param     mixed $msrp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function filterByMsrp($msrp = null, $comparison = null)
    {
        if (is_array($msrp)) {
            $useMinMax = false;
            if (isset($msrp['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_MSRP, $msrp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($msrp['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_MSRP, $msrp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductsTableMap::COL_MSRP, $msrp, $comparison);
    }

    /**
     * Filter the query by a related \Productlines object
     *
     * @param \Productlines|ObjectCollection $productlines The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductsQuery The current query, for fluid interface
     */
    public function filterByProductlines($productlines, $comparison = null)
    {
        if ($productlines instanceof \Productlines) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_PRODUCTLINE, $productlines->getProductline(), $comparison);
        } elseif ($productlines instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductsTableMap::COL_PRODUCTLINE, $productlines->toKeyValue('PrimaryKey', 'Productline'), $comparison);
        } else {
            throw new PropelException('filterByProductlines() only accepts arguments of type \Productlines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Productlines relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function joinProductlines($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Productlines');

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
            $this->addJoinObject($join, 'Productlines');
        }

        return $this;
    }

    /**
     * Use the Productlines relation Productlines object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductlinesQuery A secondary query class using the current class as primary query
     */
    public function useProductlinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductlines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Productlines', '\ProductlinesQuery');
    }

    /**
     * Use the Productlines relation Productlines object
     *
     * @param callable(\ProductlinesQuery):\ProductlinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductlinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductlinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Orderdetails object
     *
     * @param \Orderdetails|ObjectCollection $orderdetails the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductsQuery The current query, for fluid interface
     */
    public function filterByOrderdetails($orderdetails, $comparison = null)
    {
        if ($orderdetails instanceof \Orderdetails) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_PRODUCTCODE, $orderdetails->getProductcode(), $comparison);
        } elseif ($orderdetails instanceof ObjectCollection) {
            return $this
                ->useOrderdetailsQuery()
                ->filterByPrimaryKeys($orderdetails->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderdetails() only accepts arguments of type \Orderdetails or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orderdetails relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function joinOrderdetails($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orderdetails');

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
            $this->addJoinObject($join, 'Orderdetails');
        }

        return $this;
    }

    /**
     * Use the Orderdetails relation Orderdetails object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderdetailsQuery A secondary query class using the current class as primary query
     */
    public function useOrderdetailsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderdetails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orderdetails', '\OrderdetailsQuery');
    }

    /**
     * Use the Orderdetails relation Orderdetails object
     *
     * @param callable(\OrderdetailsQuery):\OrderdetailsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderdetailsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderdetailsQuery(
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
     * @param   ChildProducts $products Object to remove from the list of results
     *
     * @return $this|ChildProductsQuery The current query, for fluid interface
     */
    public function prune($products = null)
    {
        if ($products) {
            $this->addUsingAlias(ProductsTableMap::COL_PRODUCTCODE, $products->getProductcode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductsTableMap::clearInstancePool();
            ProductsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductsQuery
