<?php

namespace Base;

use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Exception;
use \PDO;
use Map\OrdersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'orders' table.
 *
 *
 *
 * @method     ChildOrdersQuery orderByOrdernumber($order = Criteria::ASC) Order by the orderNumber column
 * @method     ChildOrdersQuery orderByOrderdate($order = Criteria::ASC) Order by the orderDate column
 * @method     ChildOrdersQuery orderByRequireddate($order = Criteria::ASC) Order by the requiredDate column
 * @method     ChildOrdersQuery orderByShippeddate($order = Criteria::ASC) Order by the shippedDate column
 * @method     ChildOrdersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOrdersQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildOrdersQuery orderByCustomernumber($order = Criteria::ASC) Order by the customerNumber column
 *
 * @method     ChildOrdersQuery groupByOrdernumber() Group by the orderNumber column
 * @method     ChildOrdersQuery groupByOrderdate() Group by the orderDate column
 * @method     ChildOrdersQuery groupByRequireddate() Group by the requiredDate column
 * @method     ChildOrdersQuery groupByShippeddate() Group by the shippedDate column
 * @method     ChildOrdersQuery groupByStatus() Group by the status column
 * @method     ChildOrdersQuery groupByComments() Group by the comments column
 * @method     ChildOrdersQuery groupByCustomernumber() Group by the customerNumber column
 *
 * @method     ChildOrdersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrdersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrdersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrdersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrdersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrdersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrdersQuery leftJoinCustomers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customers relation
 * @method     ChildOrdersQuery rightJoinCustomers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customers relation
 * @method     ChildOrdersQuery innerJoinCustomers($relationAlias = null) Adds a INNER JOIN clause to the query using the Customers relation
 *
 * @method     ChildOrdersQuery joinWithCustomers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customers relation
 *
 * @method     ChildOrdersQuery leftJoinWithCustomers() Adds a LEFT JOIN clause and with to the query using the Customers relation
 * @method     ChildOrdersQuery rightJoinWithCustomers() Adds a RIGHT JOIN clause and with to the query using the Customers relation
 * @method     ChildOrdersQuery innerJoinWithCustomers() Adds a INNER JOIN clause and with to the query using the Customers relation
 *
 * @method     ChildOrdersQuery leftJoinOrderdetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderdetails relation
 * @method     ChildOrdersQuery rightJoinOrderdetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderdetails relation
 * @method     ChildOrdersQuery innerJoinOrderdetails($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderdetails relation
 *
 * @method     ChildOrdersQuery joinWithOrderdetails($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderdetails relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderdetails() Adds a LEFT JOIN clause and with to the query using the Orderdetails relation
 * @method     ChildOrdersQuery rightJoinWithOrderdetails() Adds a RIGHT JOIN clause and with to the query using the Orderdetails relation
 * @method     ChildOrdersQuery innerJoinWithOrderdetails() Adds a INNER JOIN clause and with to the query using the Orderdetails relation
 *
 * @method     \CustomersQuery|\OrderdetailsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrders|null findOne(ConnectionInterface $con = null) Return the first ChildOrders matching the query
 * @method     ChildOrders findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrders matching the query, or a new ChildOrders object populated from the query conditions when no match is found
 *
 * @method     ChildOrders|null findOneByOrdernumber(int $orderNumber) Return the first ChildOrders filtered by the orderNumber column
 * @method     ChildOrders|null findOneByOrderdate(string $orderDate) Return the first ChildOrders filtered by the orderDate column
 * @method     ChildOrders|null findOneByRequireddate(string $requiredDate) Return the first ChildOrders filtered by the requiredDate column
 * @method     ChildOrders|null findOneByShippeddate(string $shippedDate) Return the first ChildOrders filtered by the shippedDate column
 * @method     ChildOrders|null findOneByStatus(string $status) Return the first ChildOrders filtered by the status column
 * @method     ChildOrders|null findOneByComments(string $comments) Return the first ChildOrders filtered by the comments column
 * @method     ChildOrders|null findOneByCustomernumber(int $customerNumber) Return the first ChildOrders filtered by the customerNumber column *

 * @method     ChildOrders requirePk($key, ConnectionInterface $con = null) Return the ChildOrders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOne(ConnectionInterface $con = null) Return the first ChildOrders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders requireOneByOrdernumber(int $orderNumber) Return the first ChildOrders filtered by the orderNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderdate(string $orderDate) Return the first ChildOrders filtered by the orderDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByRequireddate(string $requiredDate) Return the first ChildOrders filtered by the requiredDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByShippeddate(string $shippedDate) Return the first ChildOrders filtered by the shippedDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByStatus(string $status) Return the first ChildOrders filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByComments(string $comments) Return the first ChildOrders filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByCustomernumber(int $customerNumber) Return the first ChildOrders filtered by the customerNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @method     ChildOrders[]|ObjectCollection findByOrdernumber(int $orderNumber) Return ChildOrders objects filtered by the orderNumber column
 * @method     ChildOrders[]|ObjectCollection findByOrderdate(string $orderDate) Return ChildOrders objects filtered by the orderDate column
 * @method     ChildOrders[]|ObjectCollection findByRequireddate(string $requiredDate) Return ChildOrders objects filtered by the requiredDate column
 * @method     ChildOrders[]|ObjectCollection findByShippeddate(string $shippedDate) Return ChildOrders objects filtered by the shippedDate column
 * @method     ChildOrders[]|ObjectCollection findByStatus(string $status) Return ChildOrders objects filtered by the status column
 * @method     ChildOrders[]|ObjectCollection findByComments(string $comments) Return ChildOrders objects filtered by the comments column
 * @method     ChildOrders[]|ObjectCollection findByCustomernumber(int $customerNumber) Return ChildOrders objects filtered by the customerNumber column
 * @method     ChildOrders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrdersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrdersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Orders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrdersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrdersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrdersQuery) {
            return $criteria;
        }
        $query = new ChildOrdersQuery();
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrdersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders WHERE orderNumber = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrders $obj */
            $obj = new ChildOrders();
            $obj->hydrate($row);
            OrdersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $keys, Criteria::IN);
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
     * @param     mixed $ordernumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrdernumber($ordernumber = null, $comparison = null)
    {
        if (is_array($ordernumber)) {
            $useMinMax = false;
            if (isset($ordernumber['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $ordernumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ordernumber['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $ordernumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $ordernumber, $comparison);
    }

    /**
     * Filter the query on the orderDate column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderdate('2011-03-14'); // WHERE orderDate = '2011-03-14'
     * $query->filterByOrderdate('now'); // WHERE orderDate = '2011-03-14'
     * $query->filterByOrderdate(array('max' => 'yesterday')); // WHERE orderDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $orderdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrderdate($orderdate = null, $comparison = null)
    {
        if (is_array($orderdate)) {
            $useMinMax = false;
            if (isset($orderdate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDERDATE, $orderdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderdate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDERDATE, $orderdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ORDERDATE, $orderdate, $comparison);
    }

    /**
     * Filter the query on the requiredDate column
     *
     * Example usage:
     * <code>
     * $query->filterByRequireddate('2011-03-14'); // WHERE requiredDate = '2011-03-14'
     * $query->filterByRequireddate('now'); // WHERE requiredDate = '2011-03-14'
     * $query->filterByRequireddate(array('max' => 'yesterday')); // WHERE requiredDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $requireddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByRequireddate($requireddate = null, $comparison = null)
    {
        if (is_array($requireddate)) {
            $useMinMax = false;
            if (isset($requireddate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REQUIREDDATE, $requireddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requireddate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REQUIREDDATE, $requireddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_REQUIREDDATE, $requireddate, $comparison);
    }

    /**
     * Filter the query on the shippedDate column
     *
     * Example usage:
     * <code>
     * $query->filterByShippeddate('2011-03-14'); // WHERE shippedDate = '2011-03-14'
     * $query->filterByShippeddate('now'); // WHERE shippedDate = '2011-03-14'
     * $query->filterByShippeddate(array('max' => 'yesterday')); // WHERE shippedDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $shippeddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByShippeddate($shippeddate = null, $comparison = null)
    {
        if (is_array($shippeddate)) {
            $useMinMax = false;
            if (isset($shippeddate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_SHIPPEDDATE, $shippeddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippeddate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_SHIPPEDDATE, $shippeddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_SHIPPEDDATE, $shippeddate, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%', Criteria::LIKE); // WHERE comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the customerNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomernumber(1234); // WHERE customerNumber = 1234
     * $query->filterByCustomernumber(array(12, 34)); // WHERE customerNumber IN (12, 34)
     * $query->filterByCustomernumber(array('min' => 12)); // WHERE customerNumber > 12
     * </code>
     *
     * @see       filterByCustomers()
     *
     * @param     mixed $customernumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByCustomernumber($customernumber = null, $comparison = null)
    {
        if (is_array($customernumber)) {
            $useMinMax = false;
            if (isset($customernumber['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_CUSTOMERNUMBER, $customernumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customernumber['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_CUSTOMERNUMBER, $customernumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_CUSTOMERNUMBER, $customernumber, $comparison);
    }

    /**
     * Filter the query by a related \Customers object
     *
     * @param \Customers|ObjectCollection $customers The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByCustomers($customers, $comparison = null)
    {
        if ($customers instanceof \Customers) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_CUSTOMERNUMBER, $customers->getCustomernumber(), $comparison);
        } elseif ($customers instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_CUSTOMERNUMBER, $customers->toKeyValue('PrimaryKey', 'Customernumber'), $comparison);
        } else {
            throw new PropelException('filterByCustomers() only accepts arguments of type \Customers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinCustomers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customers');

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
            $this->addJoinObject($join, 'Customers');
        }

        return $this;
    }

    /**
     * Use the Customers relation Customers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CustomersQuery A secondary query class using the current class as primary query
     */
    public function useCustomersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customers', '\CustomersQuery');
    }

    /**
     * Use the Customers relation Customers object
     *
     * @param callable(\CustomersQuery):\CustomersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCustomersQuery(
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
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrderdetails($orderdetails, $comparison = null)
    {
        if ($orderdetails instanceof \Orderdetails) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $orderdetails->getOrdernumber(), $comparison);
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
     * @return $this|ChildOrdersQuery The current query, for fluid interface
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
     * @param   ChildOrders $orders Object to remove from the list of results
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function prune($orders = null)
    {
        if ($orders) {
            $this->addUsingAlias(OrdersTableMap::COL_ORDERNUMBER, $orders->getOrdernumber(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrdersTableMap::clearInstancePool();
            OrdersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrdersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrdersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrdersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrdersQuery
