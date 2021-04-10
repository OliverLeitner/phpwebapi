<?php

namespace Base;

use \Orderdetails as ChildOrderdetails;
use \OrderdetailsQuery as ChildOrderdetailsQuery;
use \Exception;
use \PDO;
use Map\OrderdetailsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'orderdetails' table.
 *
 *
 *
 * @method     ChildOrderdetailsQuery orderByOrdernumber($order = Criteria::ASC) Order by the orderNumber column
 * @method     ChildOrderdetailsQuery orderByProductcode($order = Criteria::ASC) Order by the productCode column
 * @method     ChildOrderdetailsQuery orderByQuantityordered($order = Criteria::ASC) Order by the quantityOrdered column
 * @method     ChildOrderdetailsQuery orderByPriceeach($order = Criteria::ASC) Order by the priceEach column
 * @method     ChildOrderdetailsQuery orderByOrderlinenumber($order = Criteria::ASC) Order by the orderLineNumber column
 *
 * @method     ChildOrderdetailsQuery groupByOrdernumber() Group by the orderNumber column
 * @method     ChildOrderdetailsQuery groupByProductcode() Group by the productCode column
 * @method     ChildOrderdetailsQuery groupByQuantityordered() Group by the quantityOrdered column
 * @method     ChildOrderdetailsQuery groupByPriceeach() Group by the priceEach column
 * @method     ChildOrderdetailsQuery groupByOrderlinenumber() Group by the orderLineNumber column
 *
 * @method     ChildOrderdetailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderdetailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderdetailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderdetailsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderdetailsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderdetailsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderdetailsQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildOrderdetailsQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildOrderdetailsQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildOrderdetailsQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildOrderdetailsQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderdetailsQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderdetailsQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildOrderdetailsQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildOrderdetailsQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildOrderdetailsQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildOrderdetailsQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildOrderdetailsQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderdetailsQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderdetailsQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \OrdersQuery|\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderdetails|null findOne(ConnectionInterface $con = null) Return the first ChildOrderdetails matching the query
 * @method     ChildOrderdetails findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderdetails matching the query, or a new ChildOrderdetails object populated from the query conditions when no match is found
 *
 * @method     ChildOrderdetails|null findOneByOrdernumber(int $orderNumber) Return the first ChildOrderdetails filtered by the orderNumber column
 * @method     ChildOrderdetails|null findOneByProductcode(string $productCode) Return the first ChildOrderdetails filtered by the productCode column
 * @method     ChildOrderdetails|null findOneByQuantityordered(int $quantityOrdered) Return the first ChildOrderdetails filtered by the quantityOrdered column
 * @method     ChildOrderdetails|null findOneByPriceeach(string $priceEach) Return the first ChildOrderdetails filtered by the priceEach column
 * @method     ChildOrderdetails|null findOneByOrderlinenumber(int $orderLineNumber) Return the first ChildOrderdetails filtered by the orderLineNumber column *

 * @method     ChildOrderdetails requirePk($key, ConnectionInterface $con = null) Return the ChildOrderdetails by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderdetails requireOne(ConnectionInterface $con = null) Return the first ChildOrderdetails matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderdetails requireOneByOrdernumber(int $orderNumber) Return the first ChildOrderdetails filtered by the orderNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderdetails requireOneByProductcode(string $productCode) Return the first ChildOrderdetails filtered by the productCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderdetails requireOneByQuantityordered(int $quantityOrdered) Return the first ChildOrderdetails filtered by the quantityOrdered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderdetails requireOneByPriceeach(string $priceEach) Return the first ChildOrderdetails filtered by the priceEach column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderdetails requireOneByOrderlinenumber(int $orderLineNumber) Return the first ChildOrderdetails filtered by the orderLineNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderdetails[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderdetails objects based on current ModelCriteria
 * @method     ChildOrderdetails[]|ObjectCollection findByOrdernumber(int $orderNumber) Return ChildOrderdetails objects filtered by the orderNumber column
 * @method     ChildOrderdetails[]|ObjectCollection findByProductcode(string $productCode) Return ChildOrderdetails objects filtered by the productCode column
 * @method     ChildOrderdetails[]|ObjectCollection findByQuantityordered(int $quantityOrdered) Return ChildOrderdetails objects filtered by the quantityOrdered column
 * @method     ChildOrderdetails[]|ObjectCollection findByPriceeach(string $priceEach) Return ChildOrderdetails objects filtered by the priceEach column
 * @method     ChildOrderdetails[]|ObjectCollection findByOrderlinenumber(int $orderLineNumber) Return ChildOrderdetails objects filtered by the orderLineNumber column
 * @method     ChildOrderdetails[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderdetailsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderdetailsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Orderdetails', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderdetailsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderdetailsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderdetailsQuery) {
            return $criteria;
        }
        $query = new ChildOrderdetailsQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$orderNumber, $productCode] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrderdetails|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderdetailsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderdetailsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildOrderdetails A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber FROM orderdetails WHERE orderNumber = :p0 AND productCode = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrderdetails $obj */
            $obj = new ChildOrderdetails();
            $obj->hydrate($row);
            OrderdetailsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildOrderdetails|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(OrderdetailsTableMap::COL_PRODUCTCODE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(OrderdetailsTableMap::COL_ORDERNUMBER, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(OrderdetailsTableMap::COL_PRODUCTCODE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the orderNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByOrdernumber(1234); // WHERE orderNumber = 1234
     * $query->filterByOrdernumber(array(12, 34)); // WHERE orderNumber IN (12, 34)
     * $query->filterByOrdernumber(array('min' => 12)); // WHERE orderNumber > 12
     * </code>
     *
     * @see       filterByOrders()
     *
     * @param     mixed $ordernumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByOrdernumber($ordernumber = null, $comparison = null)
    {
        if (is_array($ordernumber)) {
            $useMinMax = false;
            if (isset($ordernumber['min'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $ordernumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ordernumber['max'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $ordernumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $ordernumber, $comparison);
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
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByProductcode($productcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderdetailsTableMap::COL_PRODUCTCODE, $productcode, $comparison);
    }

    /**
     * Filter the query on the quantityOrdered column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantityordered(1234); // WHERE quantityOrdered = 1234
     * $query->filterByQuantityordered(array(12, 34)); // WHERE quantityOrdered IN (12, 34)
     * $query->filterByQuantityordered(array('min' => 12)); // WHERE quantityOrdered > 12
     * </code>
     *
     * @param     mixed $quantityordered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByQuantityordered($quantityordered = null, $comparison = null)
    {
        if (is_array($quantityordered)) {
            $useMinMax = false;
            if (isset($quantityordered['min'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_QUANTITYORDERED, $quantityordered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantityordered['max'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_QUANTITYORDERED, $quantityordered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderdetailsTableMap::COL_QUANTITYORDERED, $quantityordered, $comparison);
    }

    /**
     * Filter the query on the priceEach column
     *
     * Example usage:
     * <code>
     * $query->filterByPriceeach(1234); // WHERE priceEach = 1234
     * $query->filterByPriceeach(array(12, 34)); // WHERE priceEach IN (12, 34)
     * $query->filterByPriceeach(array('min' => 12)); // WHERE priceEach > 12
     * </code>
     *
     * @param     mixed $priceeach The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByPriceeach($priceeach = null, $comparison = null)
    {
        if (is_array($priceeach)) {
            $useMinMax = false;
            if (isset($priceeach['min'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_PRICEEACH, $priceeach['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priceeach['max'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_PRICEEACH, $priceeach['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderdetailsTableMap::COL_PRICEEACH, $priceeach, $comparison);
    }

    /**
     * Filter the query on the orderLineNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderlinenumber(1234); // WHERE orderLineNumber = 1234
     * $query->filterByOrderlinenumber(array(12, 34)); // WHERE orderLineNumber IN (12, 34)
     * $query->filterByOrderlinenumber(array('min' => 12)); // WHERE orderLineNumber > 12
     * </code>
     *
     * @param     mixed $orderlinenumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByOrderlinenumber($orderlinenumber = null, $comparison = null)
    {
        if (is_array($orderlinenumber)) {
            $useMinMax = false;
            if (isset($orderlinenumber['min'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERLINENUMBER, $orderlinenumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderlinenumber['max'])) {
                $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERLINENUMBER, $orderlinenumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderdetailsTableMap::COL_ORDERLINENUMBER, $orderlinenumber, $comparison);
    }

    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $orders->getOrdernumber(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderdetailsTableMap::COL_ORDERNUMBER, $orders->toKeyValue('PrimaryKey', 'Ordernumber'), $comparison);
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function joinOrders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\OrdersQuery):\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Products object
     *
     * @param \Products|ObjectCollection $products The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function filterByProducts($products, $comparison = null)
    {
        if ($products instanceof \Products) {
            return $this
                ->addUsingAlias(OrderdetailsTableMap::COL_PRODUCTCODE, $products->getProductcode(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderdetailsTableMap::COL_PRODUCTCODE, $products->toKeyValue('PrimaryKey', 'Productcode'), $comparison);
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
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
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
     * @param   ChildOrderdetails $orderdetails Object to remove from the list of results
     *
     * @return $this|ChildOrderdetailsQuery The current query, for fluid interface
     */
    public function prune($orderdetails = null)
    {
        if ($orderdetails) {
            $this->addCond('pruneCond0', $this->getAliasedColName(OrderdetailsTableMap::COL_ORDERNUMBER), $orderdetails->getOrdernumber(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(OrderdetailsTableMap::COL_PRODUCTCODE), $orderdetails->getProductcode(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orderdetails table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderdetailsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderdetailsTableMap::clearInstancePool();
            OrderdetailsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderdetailsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderdetailsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderdetailsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderdetailsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderdetailsQuery
