<?php

namespace Base;

use \Employees as ChildEmployees;
use \EmployeesQuery as ChildEmployeesQuery;
use \Exception;
use \PDO;
use Map\EmployeesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'employees' table.
 *
 *
 *
 * @method     ChildEmployeesQuery orderByEmployeenumber($order = Criteria::ASC) Order by the employeeNumber column
 * @method     ChildEmployeesQuery orderByLastname($order = Criteria::ASC) Order by the lastName column
 * @method     ChildEmployeesQuery orderByFirstname($order = Criteria::ASC) Order by the firstName column
 * @method     ChildEmployeesQuery orderByExtension($order = Criteria::ASC) Order by the extension column
 * @method     ChildEmployeesQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildEmployeesQuery orderByOfficecode($order = Criteria::ASC) Order by the officeCode column
 * @method     ChildEmployeesQuery orderByReportsto($order = Criteria::ASC) Order by the reportsTo column
 * @method     ChildEmployeesQuery orderByJobtitle($order = Criteria::ASC) Order by the jobTitle column
 *
 * @method     ChildEmployeesQuery groupByEmployeenumber() Group by the employeeNumber column
 * @method     ChildEmployeesQuery groupByLastname() Group by the lastName column
 * @method     ChildEmployeesQuery groupByFirstname() Group by the firstName column
 * @method     ChildEmployeesQuery groupByExtension() Group by the extension column
 * @method     ChildEmployeesQuery groupByEmail() Group by the email column
 * @method     ChildEmployeesQuery groupByOfficecode() Group by the officeCode column
 * @method     ChildEmployeesQuery groupByReportsto() Group by the reportsTo column
 * @method     ChildEmployeesQuery groupByJobtitle() Group by the jobTitle column
 *
 * @method     ChildEmployeesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeesQuery leftJoinEmployeesRelatedByReportsto($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeesRelatedByReportsto relation
 * @method     ChildEmployeesQuery rightJoinEmployeesRelatedByReportsto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeesRelatedByReportsto relation
 * @method     ChildEmployeesQuery innerJoinEmployeesRelatedByReportsto($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeesRelatedByReportsto relation
 *
 * @method     ChildEmployeesQuery joinWithEmployeesRelatedByReportsto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeesRelatedByReportsto relation
 *
 * @method     ChildEmployeesQuery leftJoinWithEmployeesRelatedByReportsto() Adds a LEFT JOIN clause and with to the query using the EmployeesRelatedByReportsto relation
 * @method     ChildEmployeesQuery rightJoinWithEmployeesRelatedByReportsto() Adds a RIGHT JOIN clause and with to the query using the EmployeesRelatedByReportsto relation
 * @method     ChildEmployeesQuery innerJoinWithEmployeesRelatedByReportsto() Adds a INNER JOIN clause and with to the query using the EmployeesRelatedByReportsto relation
 *
 * @method     ChildEmployeesQuery leftJoinOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offices relation
 * @method     ChildEmployeesQuery rightJoinOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offices relation
 * @method     ChildEmployeesQuery innerJoinOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the Offices relation
 *
 * @method     ChildEmployeesQuery joinWithOffices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Offices relation
 *
 * @method     ChildEmployeesQuery leftJoinWithOffices() Adds a LEFT JOIN clause and with to the query using the Offices relation
 * @method     ChildEmployeesQuery rightJoinWithOffices() Adds a RIGHT JOIN clause and with to the query using the Offices relation
 * @method     ChildEmployeesQuery innerJoinWithOffices() Adds a INNER JOIN clause and with to the query using the Offices relation
 *
 * @method     ChildEmployeesQuery leftJoinCustomers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customers relation
 * @method     ChildEmployeesQuery rightJoinCustomers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customers relation
 * @method     ChildEmployeesQuery innerJoinCustomers($relationAlias = null) Adds a INNER JOIN clause to the query using the Customers relation
 *
 * @method     ChildEmployeesQuery joinWithCustomers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customers relation
 *
 * @method     ChildEmployeesQuery leftJoinWithCustomers() Adds a LEFT JOIN clause and with to the query using the Customers relation
 * @method     ChildEmployeesQuery rightJoinWithCustomers() Adds a RIGHT JOIN clause and with to the query using the Customers relation
 * @method     ChildEmployeesQuery innerJoinWithCustomers() Adds a INNER JOIN clause and with to the query using the Customers relation
 *
 * @method     ChildEmployeesQuery leftJoinEmployeesRelatedByEmployeenumber($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeesRelatedByEmployeenumber relation
 * @method     ChildEmployeesQuery rightJoinEmployeesRelatedByEmployeenumber($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeesRelatedByEmployeenumber relation
 * @method     ChildEmployeesQuery innerJoinEmployeesRelatedByEmployeenumber($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeesRelatedByEmployeenumber relation
 *
 * @method     ChildEmployeesQuery joinWithEmployeesRelatedByEmployeenumber($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeesRelatedByEmployeenumber relation
 *
 * @method     ChildEmployeesQuery leftJoinWithEmployeesRelatedByEmployeenumber() Adds a LEFT JOIN clause and with to the query using the EmployeesRelatedByEmployeenumber relation
 * @method     ChildEmployeesQuery rightJoinWithEmployeesRelatedByEmployeenumber() Adds a RIGHT JOIN clause and with to the query using the EmployeesRelatedByEmployeenumber relation
 * @method     ChildEmployeesQuery innerJoinWithEmployeesRelatedByEmployeenumber() Adds a INNER JOIN clause and with to the query using the EmployeesRelatedByEmployeenumber relation
 *
 * @method     \EmployeesQuery|\OfficesQuery|\CustomersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployees|null findOne(ConnectionInterface $con = null) Return the first ChildEmployees matching the query
 * @method     ChildEmployees findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployees matching the query, or a new ChildEmployees object populated from the query conditions when no match is found
 *
 * @method     ChildEmployees|null findOneByEmployeenumber(int $employeeNumber) Return the first ChildEmployees filtered by the employeeNumber column
 * @method     ChildEmployees|null findOneByLastname(string $lastName) Return the first ChildEmployees filtered by the lastName column
 * @method     ChildEmployees|null findOneByFirstname(string $firstName) Return the first ChildEmployees filtered by the firstName column
 * @method     ChildEmployees|null findOneByExtension(string $extension) Return the first ChildEmployees filtered by the extension column
 * @method     ChildEmployees|null findOneByEmail(string $email) Return the first ChildEmployees filtered by the email column
 * @method     ChildEmployees|null findOneByOfficecode(string $officeCode) Return the first ChildEmployees filtered by the officeCode column
 * @method     ChildEmployees|null findOneByReportsto(int $reportsTo) Return the first ChildEmployees filtered by the reportsTo column
 * @method     ChildEmployees|null findOneByJobtitle(string $jobTitle) Return the first ChildEmployees filtered by the jobTitle column *

 * @method     ChildEmployees requirePk($key, ConnectionInterface $con = null) Return the ChildEmployees by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOne(ConnectionInterface $con = null) Return the first ChildEmployees matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployees requireOneByEmployeenumber(int $employeeNumber) Return the first ChildEmployees filtered by the employeeNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByLastname(string $lastName) Return the first ChildEmployees filtered by the lastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByFirstname(string $firstName) Return the first ChildEmployees filtered by the firstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByExtension(string $extension) Return the first ChildEmployees filtered by the extension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByEmail(string $email) Return the first ChildEmployees filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByOfficecode(string $officeCode) Return the first ChildEmployees filtered by the officeCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByReportsto(int $reportsTo) Return the first ChildEmployees filtered by the reportsTo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByJobtitle(string $jobTitle) Return the first ChildEmployees filtered by the jobTitle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployees[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployees objects based on current ModelCriteria
 * @method     ChildEmployees[]|ObjectCollection findByEmployeenumber(int $employeeNumber) Return ChildEmployees objects filtered by the employeeNumber column
 * @method     ChildEmployees[]|ObjectCollection findByLastname(string $lastName) Return ChildEmployees objects filtered by the lastName column
 * @method     ChildEmployees[]|ObjectCollection findByFirstname(string $firstName) Return ChildEmployees objects filtered by the firstName column
 * @method     ChildEmployees[]|ObjectCollection findByExtension(string $extension) Return ChildEmployees objects filtered by the extension column
 * @method     ChildEmployees[]|ObjectCollection findByEmail(string $email) Return ChildEmployees objects filtered by the email column
 * @method     ChildEmployees[]|ObjectCollection findByOfficecode(string $officeCode) Return ChildEmployees objects filtered by the officeCode column
 * @method     ChildEmployees[]|ObjectCollection findByReportsto(int $reportsTo) Return ChildEmployees objects filtered by the reportsTo column
 * @method     ChildEmployees[]|ObjectCollection findByJobtitle(string $jobTitle) Return ChildEmployees objects filtered by the jobTitle column
 * @method     ChildEmployees[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EmployeesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Employees', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeesQuery) {
            return $criteria;
        }
        $query = new ChildEmployeesQuery();
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
     * @return ChildEmployees|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployees A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle FROM employees WHERE employeeNumber = :p0';
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
            /** @var ChildEmployees $obj */
            $obj = new ChildEmployees();
            $obj->hydrate($row);
            EmployeesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployees|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the employeeNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeenumber(1234); // WHERE employeeNumber = 1234
     * $query->filterByEmployeenumber(array(12, 34)); // WHERE employeeNumber IN (12, 34)
     * $query->filterByEmployeenumber(array('min' => 12)); // WHERE employeeNumber > 12
     * </code>
     *
     * @param     mixed $employeenumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByEmployeenumber($employeenumber = null, $comparison = null)
    {
        if (is_array($employeenumber)) {
            $useMinMax = false;
            if (isset($employeenumber['min'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $employeenumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeenumber['max'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $employeenumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $employeenumber, $comparison);
    }

    /**
     * Filter the query on the lastName column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastName = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the firstName column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstName = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the extension column
     *
     * Example usage:
     * <code>
     * $query->filterByExtension('fooValue');   // WHERE extension = 'fooValue'
     * $query->filterByExtension('%fooValue%', Criteria::LIKE); // WHERE extension LIKE '%fooValue%'
     * </code>
     *
     * @param     string $extension The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByExtension($extension = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($extension)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_EXTENSION, $extension, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the officeCode column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficecode('fooValue');   // WHERE officeCode = 'fooValue'
     * $query->filterByOfficecode('%fooValue%', Criteria::LIKE); // WHERE officeCode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officecode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByOfficecode($officecode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officecode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_OFFICECODE, $officecode, $comparison);
    }

    /**
     * Filter the query on the reportsTo column
     *
     * Example usage:
     * <code>
     * $query->filterByReportsto(1234); // WHERE reportsTo = 1234
     * $query->filterByReportsto(array(12, 34)); // WHERE reportsTo IN (12, 34)
     * $query->filterByReportsto(array('min' => 12)); // WHERE reportsTo > 12
     * </code>
     *
     * @see       filterByEmployeesRelatedByReportsto()
     *
     * @param     mixed $reportsto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByReportsto($reportsto = null, $comparison = null)
    {
        if (is_array($reportsto)) {
            $useMinMax = false;
            if (isset($reportsto['min'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_REPORTSTO, $reportsto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reportsto['max'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_REPORTSTO, $reportsto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_REPORTSTO, $reportsto, $comparison);
    }

    /**
     * Filter the query on the jobTitle column
     *
     * Example usage:
     * <code>
     * $query->filterByJobtitle('fooValue');   // WHERE jobTitle = 'fooValue'
     * $query->filterByJobtitle('%fooValue%', Criteria::LIKE); // WHERE jobTitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jobtitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByJobtitle($jobtitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jobtitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeesTableMap::COL_JOBTITLE, $jobtitle, $comparison);
    }

    /**
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByEmployeesRelatedByReportsto($employees, $comparison = null)
    {
        if ($employees instanceof \Employees) {
            return $this
                ->addUsingAlias(EmployeesTableMap::COL_REPORTSTO, $employees->getEmployeenumber(), $comparison);
        } elseif ($employees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeesTableMap::COL_REPORTSTO, $employees->toKeyValue('PrimaryKey', 'Employeenumber'), $comparison);
        } else {
            throw new PropelException('filterByEmployeesRelatedByReportsto() only accepts arguments of type \Employees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeesRelatedByReportsto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function joinEmployeesRelatedByReportsto($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeesRelatedByReportsto');

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
            $this->addJoinObject($join, 'EmployeesRelatedByReportsto');
        }

        return $this;
    }

    /**
     * Use the EmployeesRelatedByReportsto relation Employees object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmployeesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesRelatedByReportstoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeesRelatedByReportsto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeesRelatedByReportsto', '\EmployeesQuery');
    }

    /**
     * Use the EmployeesRelatedByReportsto relation Employees object
     *
     * @param callable(\EmployeesQuery):\EmployeesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeesRelatedByReportstoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeesRelatedByReportstoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Offices object
     *
     * @param \Offices|ObjectCollection $offices The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByOffices($offices, $comparison = null)
    {
        if ($offices instanceof \Offices) {
            return $this
                ->addUsingAlias(EmployeesTableMap::COL_OFFICECODE, $offices->getOfficecode(), $comparison);
        } elseif ($offices instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeesTableMap::COL_OFFICECODE, $offices->toKeyValue('PrimaryKey', 'Officecode'), $comparison);
        } else {
            throw new PropelException('filterByOffices() only accepts arguments of type \Offices or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Offices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function joinOffices($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Offices');

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
            $this->addJoinObject($join, 'Offices');
        }

        return $this;
    }

    /**
     * Use the Offices relation Offices object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OfficesQuery A secondary query class using the current class as primary query
     */
    public function useOfficesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOffices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Offices', '\OfficesQuery');
    }

    /**
     * Use the Offices relation Offices object
     *
     * @param callable(\OfficesQuery):\OfficesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOfficesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOfficesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Customers object
     *
     * @param \Customers|ObjectCollection $customers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByCustomers($customers, $comparison = null)
    {
        if ($customers instanceof \Customers) {
            return $this
                ->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $customers->getSalesrepemployeenumber(), $comparison);
        } elseif ($customers instanceof ObjectCollection) {
            return $this
                ->useCustomersQuery()
                ->filterByPrimaryKeys($customers->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function joinCustomers($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useCustomersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeesQuery The current query, for fluid interface
     */
    public function filterByEmployeesRelatedByEmployeenumber($employees, $comparison = null)
    {
        if ($employees instanceof \Employees) {
            return $this
                ->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $employees->getReportsto(), $comparison);
        } elseif ($employees instanceof ObjectCollection) {
            return $this
                ->useEmployeesRelatedByEmployeenumberQuery()
                ->filterByPrimaryKeys($employees->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmployeesRelatedByEmployeenumber() only accepts arguments of type \Employees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeesRelatedByEmployeenumber relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function joinEmployeesRelatedByEmployeenumber($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeesRelatedByEmployeenumber');

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
            $this->addJoinObject($join, 'EmployeesRelatedByEmployeenumber');
        }

        return $this;
    }

    /**
     * Use the EmployeesRelatedByEmployeenumber relation Employees object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmployeesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesRelatedByEmployeenumberQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeesRelatedByEmployeenumber($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeesRelatedByEmployeenumber', '\EmployeesQuery');
    }

    /**
     * Use the EmployeesRelatedByEmployeenumber relation Employees object
     *
     * @param callable(\EmployeesQuery):\EmployeesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeesRelatedByEmployeenumberQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeesRelatedByEmployeenumberQuery(
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
     * @param   ChildEmployees $employees Object to remove from the list of results
     *
     * @return $this|ChildEmployeesQuery The current query, for fluid interface
     */
    public function prune($employees = null)
    {
        if ($employees) {
            $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEENUMBER, $employees->getEmployeenumber(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeesTableMap::clearInstancePool();
            EmployeesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeesQuery
