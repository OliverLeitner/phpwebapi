<?php

namespace Base;

use \Offices as ChildOffices;
use \OfficesQuery as ChildOfficesQuery;
use \Exception;
use \PDO;
use Map\OfficesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'offices' table.
 *
 *
 *
 * @method     ChildOfficesQuery orderByOfficecode($order = Criteria::ASC) Order by the officeCode column
 * @method     ChildOfficesQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildOfficesQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildOfficesQuery orderByAddressline1($order = Criteria::ASC) Order by the addressLine1 column
 * @method     ChildOfficesQuery orderByAddressline2($order = Criteria::ASC) Order by the addressLine2 column
 * @method     ChildOfficesQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildOfficesQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildOfficesQuery orderByPostalcode($order = Criteria::ASC) Order by the postalCode column
 * @method     ChildOfficesQuery orderByTerritory($order = Criteria::ASC) Order by the territory column
 *
 * @method     ChildOfficesQuery groupByOfficecode() Group by the officeCode column
 * @method     ChildOfficesQuery groupByCity() Group by the city column
 * @method     ChildOfficesQuery groupByPhone() Group by the phone column
 * @method     ChildOfficesQuery groupByAddressline1() Group by the addressLine1 column
 * @method     ChildOfficesQuery groupByAddressline2() Group by the addressLine2 column
 * @method     ChildOfficesQuery groupByState() Group by the state column
 * @method     ChildOfficesQuery groupByCountry() Group by the country column
 * @method     ChildOfficesQuery groupByPostalcode() Group by the postalCode column
 * @method     ChildOfficesQuery groupByTerritory() Group by the territory column
 *
 * @method     ChildOfficesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOfficesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOfficesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOfficesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOfficesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOfficesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOfficesQuery leftJoinEmployees($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employees relation
 * @method     ChildOfficesQuery rightJoinEmployees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employees relation
 * @method     ChildOfficesQuery innerJoinEmployees($relationAlias = null) Adds a INNER JOIN clause to the query using the Employees relation
 *
 * @method     ChildOfficesQuery joinWithEmployees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employees relation
 *
 * @method     ChildOfficesQuery leftJoinWithEmployees() Adds a LEFT JOIN clause and with to the query using the Employees relation
 * @method     ChildOfficesQuery rightJoinWithEmployees() Adds a RIGHT JOIN clause and with to the query using the Employees relation
 * @method     ChildOfficesQuery innerJoinWithEmployees() Adds a INNER JOIN clause and with to the query using the Employees relation
 *
 * @method     \EmployeesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOffices|null findOne(ConnectionInterface $con = null) Return the first ChildOffices matching the query
 * @method     ChildOffices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOffices matching the query, or a new ChildOffices object populated from the query conditions when no match is found
 *
 * @method     ChildOffices|null findOneByOfficecode(string $officeCode) Return the first ChildOffices filtered by the officeCode column
 * @method     ChildOffices|null findOneByCity(string $city) Return the first ChildOffices filtered by the city column
 * @method     ChildOffices|null findOneByPhone(string $phone) Return the first ChildOffices filtered by the phone column
 * @method     ChildOffices|null findOneByAddressline1(string $addressLine1) Return the first ChildOffices filtered by the addressLine1 column
 * @method     ChildOffices|null findOneByAddressline2(string $addressLine2) Return the first ChildOffices filtered by the addressLine2 column
 * @method     ChildOffices|null findOneByState(string $state) Return the first ChildOffices filtered by the state column
 * @method     ChildOffices|null findOneByCountry(string $country) Return the first ChildOffices filtered by the country column
 * @method     ChildOffices|null findOneByPostalcode(string $postalCode) Return the first ChildOffices filtered by the postalCode column
 * @method     ChildOffices|null findOneByTerritory(string $territory) Return the first ChildOffices filtered by the territory column *

 * @method     ChildOffices requirePk($key, ConnectionInterface $con = null) Return the ChildOffices by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOne(ConnectionInterface $con = null) Return the first ChildOffices matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOffices requireOneByOfficecode(string $officeCode) Return the first ChildOffices filtered by the officeCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByCity(string $city) Return the first ChildOffices filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByPhone(string $phone) Return the first ChildOffices filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByAddressline1(string $addressLine1) Return the first ChildOffices filtered by the addressLine1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByAddressline2(string $addressLine2) Return the first ChildOffices filtered by the addressLine2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByState(string $state) Return the first ChildOffices filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByCountry(string $country) Return the first ChildOffices filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByPostalcode(string $postalCode) Return the first ChildOffices filtered by the postalCode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffices requireOneByTerritory(string $territory) Return the first ChildOffices filtered by the territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOffices[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOffices objects based on current ModelCriteria
 * @method     ChildOffices[]|ObjectCollection findByOfficecode(string $officeCode) Return ChildOffices objects filtered by the officeCode column
 * @method     ChildOffices[]|ObjectCollection findByCity(string $city) Return ChildOffices objects filtered by the city column
 * @method     ChildOffices[]|ObjectCollection findByPhone(string $phone) Return ChildOffices objects filtered by the phone column
 * @method     ChildOffices[]|ObjectCollection findByAddressline1(string $addressLine1) Return ChildOffices objects filtered by the addressLine1 column
 * @method     ChildOffices[]|ObjectCollection findByAddressline2(string $addressLine2) Return ChildOffices objects filtered by the addressLine2 column
 * @method     ChildOffices[]|ObjectCollection findByState(string $state) Return ChildOffices objects filtered by the state column
 * @method     ChildOffices[]|ObjectCollection findByCountry(string $country) Return ChildOffices objects filtered by the country column
 * @method     ChildOffices[]|ObjectCollection findByPostalcode(string $postalCode) Return ChildOffices objects filtered by the postalCode column
 * @method     ChildOffices[]|ObjectCollection findByTerritory(string $territory) Return ChildOffices objects filtered by the territory column
 * @method     ChildOffices[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OfficesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OfficesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Offices', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOfficesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOfficesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOfficesQuery) {
            return $criteria;
        }
        $query = new ChildOfficesQuery();
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
     * @return ChildOffices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OfficesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OfficesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOffices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT officeCode, city, phone, addressLine1, addressLine2, state, country, postalCode, territory FROM offices WHERE officeCode = :p0';
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
            /** @var ChildOffices $obj */
            $obj = new ChildOffices();
            $obj->hydrate($row);
            OfficesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOffices|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OfficesTableMap::COL_OFFICECODE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OfficesTableMap::COL_OFFICECODE, $keys, Criteria::IN);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByOfficecode($officecode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officecode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_OFFICECODE, $officecode, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_CITY, $city, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByAddressline1($addressline1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_ADDRESSLINE1, $addressline1, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByAddressline2($addressline2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressline2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_ADDRESSLINE2, $addressline2, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_STATE, $state, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_COUNTRY, $country, $comparison);
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByPostalcode($postalcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postalcode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_POSTALCODE, $postalcode, $comparison);
    }

    /**
     * Filter the query on the territory column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritory('fooValue');   // WHERE territory = 'fooValue'
     * $query->filterByTerritory('%fooValue%', Criteria::LIKE); // WHERE territory LIKE '%fooValue%'
     * </code>
     *
     * @param     string $territory The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByTerritory($territory = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territory)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfficesTableMap::COL_TERRITORY, $territory, $comparison);
    }

    /**
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOfficesQuery The current query, for fluid interface
     */
    public function filterByEmployees($employees, $comparison = null)
    {
        if ($employees instanceof \Employees) {
            return $this
                ->addUsingAlias(OfficesTableMap::COL_OFFICECODE, $employees->getOfficecode(), $comparison);
        } elseif ($employees instanceof ObjectCollection) {
            return $this
                ->useEmployeesQuery()
                ->filterByPrimaryKeys($employees->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function joinEmployees($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useEmployeesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Exclude object from result
     *
     * @param   ChildOffices $offices Object to remove from the list of results
     *
     * @return $this|ChildOfficesQuery The current query, for fluid interface
     */
    public function prune($offices = null)
    {
        if ($offices) {
            $this->addUsingAlias(OfficesTableMap::COL_OFFICECODE, $offices->getOfficecode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the offices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OfficesTableMap::clearInstancePool();
            OfficesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OfficesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OfficesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OfficesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OfficesQuery
