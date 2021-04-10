<?php

namespace Base;

use \Customers as ChildCustomers;
use \CustomersQuery as ChildCustomersQuery;
use \Exception;
use \PDO;
use Map\CustomersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'customers' table.
 *
 *
 *
 * @method     ChildCustomersQuery orderByCustomernumber($order = Criteria::ASC) Order by the customerNumber column
 * @method     ChildCustomersQuery orderByCustomername($order = Criteria::ASC) Order by the customerName column
 * @method     ChildCustomersQuery orderByContactlastname($order = Criteria::ASC) Order by the contactLastName column
 * @method     ChildCustomersQuery orderByContactfirstname($order = Criteria::ASC) Order by the contactFirstName column
 * @method     ChildCustomersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildCustomersQuery orderByAddressline1($order = Criteria::ASC) Order by the addressLine1 column
 * @method     ChildCustomersQuery orderByAddressline2($order = Criteria::ASC) Order by the addressLine2 column
 * @method     ChildCustomersQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildCustomersQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildCustomersQuery orderByPostalcode($order = Criteria::ASC) Order by the postalCode column
 * @method     ChildCustomersQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildCustomersQuery orderBySalesrepemployeenumber($order = Criteria::ASC) Order by the salesRepEmployeeNumber column
 * @method     ChildCustomersQuery orderByCreditlimit($order = Criteria::ASC) Order by the creditLimit column
 *
 * @method     ChildCustomersQuery groupByCustomernumber() Group by the customerNumber column
 * @method     ChildCustomersQuery groupByCustomername() Group by the customerName column
 * @method     ChildCustomersQuery groupByContactlastname() Group by the contactLastName column
 * @method     ChildCustomersQuery groupByContactfirstname() Group by the contactFirstName column
 * @method     ChildCustomersQuery groupByPhone() Group by the phone column
 * @method     ChildCustomersQuery groupByAddressline1() Group by the addressLine1 column
 * @method     ChildCustomersQuery groupByAddressline2() Group by the addressLine2 column
 * @method     ChildCustomersQuery groupByCity() Group by the city column
 * @method     ChildCustomersQuery groupByState() Group by the state column
 * @method     ChildCustomersQuery groupByPostalcode() Group by the postalCode column
 * @method     ChildCustomersQuery groupByCountry() Group by the country column
 * @method     ChildCustomersQuery groupBySalesrepemployeenumber() Group by the salesRepEmployeeNumber column
 * @method     ChildCustomersQuery groupByCreditlimit() Group by the creditLimit column
 *
 * @method     ChildCustomersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCustomersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCustomersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCustomersQuery leftJoinEmployees($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employees relation
 * @method     ChildCustomersQuery rightJoinEmployees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employees relation
 * @method     ChildCustomersQuery innerJoinEmployees($relationAlias = null) Adds a INNER JOIN clause to the query using the Employees relation
 *
 * @method     ChildCustomersQuery joinWithEmployees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employees relation
 *
 * @method     ChildCustomersQuery leftJoinWithEmployees() Adds a LEFT JOIN clause and with to the query using the Employees relation
 * @method     ChildCustomersQuery rightJoinWithEmployees() Adds a RIGHT JOIN clause and with to the query using the Employees relation
 * @method     ChildCustomersQuery innerJoinWithEmployees() Adds a INNER JOIN clause and with to the query using the Employees relation
 *
 * @method     ChildCustomersQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildCustomersQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildCustomersQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildCustomersQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildCustomersQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildCustomersQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildCustomersQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildCustomersQuery leftJoinPayments($relationAlias = null) Adds a LEFT JOIN clause to the query using the Payments relation
 * @method     ChildCustomersQuery rightJoinPayments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Payments relation
 * @method     ChildCustomersQuery innerJoinPayments($relationAlias = null) Adds a INNER JOIN clause to the query using the Payments relation
 *
 * @method     ChildCustomersQuery joinWithPayments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Payments relation
 *
 * @method     ChildCustomersQuery leftJoinWithPayments() Adds a LEFT JOIN clause and with to the query using the Payments relation
 * @method     ChildCustomersQuery rightJoinWithPayments() Adds a RIGHT JOIN clause and with to the query using the Payments relation
 * @method     ChildCustomersQuery innerJoinWithPayments() Adds a INNER JOIN clause and with to the query using the Payments relation
 *
 * @method     \EmployeesQuery|\OrdersQuery|\PaymentsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCustomers|null findOne(ConnectionInterface $con = null) Return the first ChildCustomers matching the query
 * @method     ChildCustomers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomers matching the query, or a new ChildCustomers object populated from the query conditions when no match is found
 *
 * @method     ChildCustomers|null findOneByCustomernumber(int $customerNumber) Return the first ChildCustomers filtered by the customerNumber column
 * @method     ChildCustomers|null findOneByCustomername(string $customerName) Return the first ChildCustomers filtered by the customerName column
 * @method     ChildCustomers|null findOneByContactlastname(string $contactLastName) Return the first ChildCustomers filtered by the contactLastName column
 * @method     ChildCustomers|null findOneByContactfirstname(string $contactFirstName) Return the first ChildCustomers filtered by the contactFirstName column
 * @method     ChildCustomers|null findOneByPhone(string $phone) Return the first ChildCustomers filtered by the phone column
 * @method     ChildCustomers|null findOneByAddressline1(string $addressLine1) Return the first ChildCustomers filtered by the addressLine1 column
 * @method     ChildCustomers|null findOneByAddressline2(string $addressLine2) Return the first ChildCustomers filtered by the addressLine2 column
 * @method     ChildCustomers|null findOneByCity(string $city) Return the first ChildCustomers filtered by the city column
 * @method     ChildCustomers|null findOneByState(string $state) Return the first ChildCustomers filtered by the state column
 * @method     ChildCustomers|null findOneByPostalcode(string $postalCode) Return the first ChildCustomers filtered by the postalCode column
 * @method     ChildCustomers|null findOneByCountry(string $country) Return the first ChildCustomers filtered by the country column
 * @method     ChildCustomers|null findOneBySalesrepemployeenumber(int $salesRepEmployeeNumber) Return the first ChildCustomers filtered by the salesRepEmployeeNumber column
 * @method     ChildCustomers|null findOneByCreditlimit(string $creditLimit) Return the first ChildCustomers filtered by the creditLimit column *

 * @method     ChildCustomers requirePk($key, ConnectionInterface $con = null) Return the ChildCustomers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOne(ConnectionInterface $con = null) Return the first ChildCustomers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomers requireOneByCustomernumber(int $customerNumber) Return the first ChildCustomers filtered by the customerNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByCustomername(string $customerName) Return the first ChildCustomers filtered by the customerName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByContactlastname(string $contactLastName) Return the first ChildCustomers filtered by the contactLastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByContactfirstname(string $contactFirstName) Return the first ChildCustomers filtered by the contactFirstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByPhone(string $phone) Return the first ChildCustomers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByAddressline1(string $addressLine1) Return the first ChildCustomers filtered by the addressLine1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByAddressline2(string $addressLine2) Return the first ChildCustomers filtered by the addressLine2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByCity(string $city) Return the first ChildCustomers filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByState(string $state) Return the first ChildCustomers filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByPostalcode(string $postalCode) Return the first ChildCustomers filtered by the postalCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByCountry(string $country) Return the first ChildCustomers filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneBySalesrepemployeenumber(int $salesRepEmployeeNumber) Return the first ChildCustomers filtered by the salesRepEmployeeNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomers requireOneByCreditlimit(string $creditLimit) Return the first ChildCustomers filtered by the creditLimit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCustomers objects based on current ModelCriteria
 * @method     ChildCustomers[]|ObjectCollection findByCustomernumber(int $customerNumber) Return ChildCustomers objects filtered by the customerNumber column
 * @method     ChildCustomers[]|ObjectCollection findByCustomername(string $customerName) Return ChildCustomers objects filtered by the customerName column
 * @method     ChildCustomers[]|ObjectCollection findByContactlastname(string $contactLastName) Return ChildCustomers objects filtered by the contactLastName column
 * @method     ChildCustomers[]|ObjectCollection findByContactfirstname(string $contactFirstName) Return ChildCustomers objects filtered by the contactFirstName column
 * @method     ChildCustomers[]|ObjectCollection findByPhone(string $phone) Return ChildCustomers objects filtered by the phone column
 * @method     ChildCustomers[]|ObjectCollection findByAddressline1(string $addressLine1) Return ChildCustomers objects filtered by the addressLine1 column
 * @method     ChildCustomers[]|ObjectCollection findByAddressline2(string $addressLine2) Return ChildCustomers objects filtered by the addressLine2 column
 * @method     ChildCustomers[]|ObjectCollection findByCity(string $city) Return ChildCustomers objects filtered by the city column
 * @method     ChildCustomers[]|ObjectCollection findByState(string $state) Return ChildCustomers objects filtered by the state column
 * @method     ChildCustomers[]|ObjectCollection findByPostalcode(string $postalCode) Return ChildCustomers objects filtered by the postalCode column
 * @method     ChildCustomers[]|ObjectCollection findByCountry(string $country) Return ChildCustomers objects filtered by the country column
 * @method     ChildCustomers[]|ObjectCollection findBySalesrepemployeenumber(int $salesRepEmployeeNumber) Return ChildCustomers objects filtered by the salesRepEmployeeNumber column
 * @method     ChildCustomers[]|ObjectCollection findByCreditlimit(string $creditLimit) Return ChildCustomers objects filtered by the creditLimit column
 * @method     ChildCustomers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CustomersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CustomersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Customers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCustomersQuery) {
            return $criteria;
        }
        $query = new ChildCustomersQuery();
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
     * @return ChildCustomers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CustomersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCustomers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT customerNumber, customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit FROM customers WHERE customerNumber = :p0';
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
            /** @var ChildCustomers $obj */
            $obj = new ChildCustomers();
            $obj->hydrate($row);
            CustomersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCustomers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $keys, Criteria::IN);
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
     * @param     mixed $customernumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByCustomernumber($customernumber = null, $comparison = null)
    {
        if (is_array($customernumber)) {
            $useMinMax = false;
            if (isset($customernumber['min'])) {
                $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $customernumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customernumber['max'])) {
                $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $customernumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $customernumber, $comparison);
    }

    /**
     * Filter the query on the customerName column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomername('fooValue');   // WHERE customerName = 'fooValue'
     * $query->filterByCustomername('%fooValue%', Criteria::LIKE); // WHERE customerName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customername The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByCustomername($customername = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customername)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNAME, $customername, $comparison);
    }

    /**
     * Filter the query on the contactLastName column
     *
     * Example usage:
     * <code>
     * $query->filterByContactlastname('fooValue');   // WHERE contactLastName = 'fooValue'
     * $query->filterByContactlastname('%fooValue%', Criteria::LIKE); // WHERE contactLastName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactlastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByContactlastname($contactlastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactlastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CONTACTLASTNAME, $contactlastname, $comparison);
    }

    /**
     * Filter the query on the contactFirstName column
     *
     * Example usage:
     * <code>
     * $query->filterByContactfirstname('fooValue');   // WHERE contactFirstName = 'fooValue'
     * $query->filterByContactfirstname('%fooValue%', Criteria::LIKE); // WHERE contactFirstName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactfirstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByContactfirstname($contactfirstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactfirstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CONTACTFIRSTNAME, $contactfirstname, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the addressLine1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressline1('fooValue');   // WHERE addressLine1 = 'fooValue'
     * $query->filterByAddressline1('%fooValue%', Criteria::LIKE); // WHERE addressLine1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressline1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByAddressline1($addressline1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_ADDRESSLINE1, $addressline1, $comparison);
    }

    /**
     * Filter the query on the addressLine2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressline2('fooValue');   // WHERE addressLine2 = 'fooValue'
     * $query->filterByAddressline2('%fooValue%', Criteria::LIKE); // WHERE addressLine2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressline2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByAddressline2($addressline2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_ADDRESSLINE2, $addressline2, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%', Criteria::LIKE); // WHERE state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $state The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the postalCode column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalcode('fooValue');   // WHERE postalCode = 'fooValue'
     * $query->filterByPostalcode('%fooValue%', Criteria::LIKE); // WHERE postalCode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postalcode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByPostalcode($postalcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postalcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_POSTALCODE, $postalcode, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%', Criteria::LIKE); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the salesRepEmployeeNumber column
     *
     * Example usage:
     * <code>
     * $query->filterBySalesrepemployeenumber(1234); // WHERE salesRepEmployeeNumber = 1234
     * $query->filterBySalesrepemployeenumber(array(12, 34)); // WHERE salesRepEmployeeNumber IN (12, 34)
     * $query->filterBySalesrepemployeenumber(array('min' => 12)); // WHERE salesRepEmployeeNumber > 12
     * </code>
     *
     * @see       filterByEmployees()
     *
     * @param     mixed $salesrepemployeenumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterBySalesrepemployeenumber($salesrepemployeenumber = null, $comparison = null)
    {
        if (is_array($salesrepemployeenumber)) {
            $useMinMax = false;
            if (isset($salesrepemployeenumber['min'])) {
                $this->addUsingAlias(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $salesrepemployeenumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($salesrepemployeenumber['max'])) {
                $this->addUsingAlias(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $salesrepemployeenumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $salesrepemployeenumber, $comparison);
    }

    /**
     * Filter the query on the creditLimit column
     *
     * Example usage:
     * <code>
     * $query->filterByCreditlimit(1234); // WHERE creditLimit = 1234
     * $query->filterByCreditlimit(array(12, 34)); // WHERE creditLimit IN (12, 34)
     * $query->filterByCreditlimit(array('min' => 12)); // WHERE creditLimit > 12
     * </code>
     *
     * @param     mixed $creditlimit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByCreditlimit($creditlimit = null, $comparison = null)
    {
        if (is_array($creditlimit)) {
            $useMinMax = false;
            if (isset($creditlimit['min'])) {
                $this->addUsingAlias(CustomersTableMap::COL_CREDITLIMIT, $creditlimit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creditlimit['max'])) {
                $this->addUsingAlias(CustomersTableMap::COL_CREDITLIMIT, $creditlimit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomersTableMap::COL_CREDITLIMIT, $creditlimit, $comparison);
    }

    /**
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByEmployees($employees, $comparison = null)
    {
        if ($employees instanceof \Employees) {
            return $this
                ->addUsingAlias(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $employees->getEmployeenumber(), $comparison);
        } elseif ($employees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $employees->toKeyValue('PrimaryKey', 'Employeenumber'), $comparison);
        } else {
            throw new PropelException('filterByEmployees() only accepts arguments of type \Employees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employees relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function joinEmployees($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employees');

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
            $this->addJoinObject($join, 'Employees');
        }

        return $this;
    }

    /**
     * Use the Employees relation Employees object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmployeesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployees($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employees', '\EmployeesQuery');
    }

    /**
     * Use the Employees relation Employees object
     *
     * @param callable(\EmployeesQuery):\EmployeesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $orders->getCustomernumber(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            return $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildCustomersQuery The current query, for fluid interface
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
     * Filter the query by a related \Payments object
     *
     * @param \Payments|ObjectCollection $payments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomersQuery The current query, for fluid interface
     */
    public function filterByPayments($payments, $comparison = null)
    {
        if ($payments instanceof \Payments) {
            return $this
                ->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $payments->getCustomernumber(), $comparison);
        } elseif ($payments instanceof ObjectCollection) {
            return $this
                ->usePaymentsQuery()
                ->filterByPrimaryKeys($payments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPayments() only accepts arguments of type \Payments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Payments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function joinPayments($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Payments');

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
            $this->addJoinObject($join, 'Payments');
        }

        return $this;
    }

    /**
     * Use the Payments relation Payments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PaymentsQuery A secondary query class using the current class as primary query
     */
    public function usePaymentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPayments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Payments', '\PaymentsQuery');
    }

    /**
     * Use the Payments relation Payments object
     *
     * @param callable(\PaymentsQuery):\PaymentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPaymentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePaymentsQuery(
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
     * @param   ChildCustomers $customers Object to remove from the list of results
     *
     * @return $this|ChildCustomersQuery The current query, for fluid interface
     */
    public function prune($customers = null)
    {
        if ($customers) {
            $this->addUsingAlias(CustomersTableMap::COL_CUSTOMERNUMBER, $customers->getCustomernumber(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the customers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CustomersTableMap::clearInstancePool();
            CustomersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CustomersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CustomersQuery
