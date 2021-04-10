<?php

namespace Base;

use \Payments as ChildPayments;
use \PaymentsQuery as ChildPaymentsQuery;
use \Exception;
use \PDO;
use Map\PaymentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'payments' table.
 *
 *
 *
 * @method     ChildPaymentsQuery orderByCustomernumber($order = Criteria::ASC) Order by the customerNumber column
 * @method     ChildPaymentsQuery orderByChecknumber($order = Criteria::ASC) Order by the checkNumber column
 * @method     ChildPaymentsQuery orderByPaymentdate($order = Criteria::ASC) Order by the paymentDate column
 * @method     ChildPaymentsQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 *
 * @method     ChildPaymentsQuery groupByCustomernumber() Group by the customerNumber column
 * @method     ChildPaymentsQuery groupByChecknumber() Group by the checkNumber column
 * @method     ChildPaymentsQuery groupByPaymentdate() Group by the paymentDate column
 * @method     ChildPaymentsQuery groupByAmount() Group by the amount column
 *
 * @method     ChildPaymentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPaymentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPaymentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPaymentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPaymentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPaymentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPaymentsQuery leftJoinCustomers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customers relation
 * @method     ChildPaymentsQuery rightJoinCustomers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customers relation
 * @method     ChildPaymentsQuery innerJoinCustomers($relationAlias = null) Adds a INNER JOIN clause to the query using the Customers relation
 *
 * @method     ChildPaymentsQuery joinWithCustomers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customers relation
 *
 * @method     ChildPaymentsQuery leftJoinWithCustomers() Adds a LEFT JOIN clause and with to the query using the Customers relation
 * @method     ChildPaymentsQuery rightJoinWithCustomers() Adds a RIGHT JOIN clause and with to the query using the Customers relation
 * @method     ChildPaymentsQuery innerJoinWithCustomers() Adds a INNER JOIN clause and with to the query using the Customers relation
 *
 * @method     \CustomersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPayments|null findOne(ConnectionInterface $con = null) Return the first ChildPayments matching the query
 * @method     ChildPayments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPayments matching the query, or a new ChildPayments object populated from the query conditions when no match is found
 *
 * @method     ChildPayments|null findOneByCustomernumber(int $customerNumber) Return the first ChildPayments filtered by the customerNumber column
 * @method     ChildPayments|null findOneByChecknumber(string $checkNumber) Return the first ChildPayments filtered by the checkNumber column
 * @method     ChildPayments|null findOneByPaymentdate(string $paymentDate) Return the first ChildPayments filtered by the paymentDate column
 * @method     ChildPayments|null findOneByAmount(string $amount) Return the first ChildPayments filtered by the amount column *

 * @method     ChildPayments requirePk($key, ConnectionInterface $con = null) Return the ChildPayments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPayments requireOne(ConnectionInterface $con = null) Return the first ChildPayments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPayments requireOneByCustomernumber(int $customerNumber) Return the first ChildPayments filtered by the customerNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPayments requireOneByChecknumber(string $checkNumber) Return the first ChildPayments filtered by the checkNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPayments requireOneByPaymentdate(string $paymentDate) Return the first ChildPayments filtered by the paymentDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPayments requireOneByAmount(string $amount) Return the first ChildPayments filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPayments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPayments objects based on current ModelCriteria
 * @method     ChildPayments[]|ObjectCollection findByCustomernumber(int $customerNumber) Return ChildPayments objects filtered by the customerNumber column
 * @method     ChildPayments[]|ObjectCollection findByChecknumber(string $checkNumber) Return ChildPayments objects filtered by the checkNumber column
 * @method     ChildPayments[]|ObjectCollection findByPaymentdate(string $paymentDate) Return ChildPayments objects filtered by the paymentDate column
 * @method     ChildPayments[]|ObjectCollection findByAmount(string $amount) Return ChildPayments objects filtered by the amount column
 * @method     ChildPayments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PaymentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PaymentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Payments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPaymentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPaymentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPaymentsQuery) {
            return $criteria;
        }
        $query = new ChildPaymentsQuery();
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
     * @param array[$customerNumber, $checkNumber] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPayments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PaymentsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PaymentsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildPayments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT customerNumber, checkNumber, paymentDate, amount FROM payments WHERE customerNumber = :p0 AND checkNumber = :p1';
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
            /** @var ChildPayments $obj */
            $obj = new ChildPayments();
            $obj->hydrate($row);
            PaymentsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildPayments|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PaymentsTableMap::COL_CHECKNUMBER, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PaymentsTableMap::COL_CUSTOMERNUMBER, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PaymentsTableMap::COL_CHECKNUMBER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByCustomernumber($customernumber = null, $comparison = null)
    {
        if (is_array($customernumber)) {
            $useMinMax = false;
            if (isset($customernumber['min'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $customernumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customernumber['max'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $customernumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $customernumber, $comparison);
    }

    /**
     * Filter the query on the checkNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByChecknumber('fooValue');   // WHERE checkNumber = 'fooValue'
     * $query->filterByChecknumber('%fooValue%', Criteria::LIKE); // WHERE checkNumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $checknumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByChecknumber($checknumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($checknumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentsTableMap::COL_CHECKNUMBER, $checknumber, $comparison);
    }

    /**
     * Filter the query on the paymentDate column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentdate('2011-03-14'); // WHERE paymentDate = '2011-03-14'
     * $query->filterByPaymentdate('now'); // WHERE paymentDate = '2011-03-14'
     * $query->filterByPaymentdate(array('max' => 'yesterday')); // WHERE paymentDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $paymentdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByPaymentdate($paymentdate = null, $comparison = null)
    {
        if (is_array($paymentdate)) {
            $useMinMax = false;
            if (isset($paymentdate['min'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_PAYMENTDATE, $paymentdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentdate['max'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_PAYMENTDATE, $paymentdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentsTableMap::COL_PAYMENTDATE, $paymentdate, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(PaymentsTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentsTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query by a related \Customers object
     *
     * @param \Customers|ObjectCollection $customers The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPaymentsQuery The current query, for fluid interface
     */
    public function filterByCustomers($customers, $comparison = null)
    {
        if ($customers instanceof \Customers) {
            return $this
                ->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $customers->getCustomernumber(), $comparison);
        } elseif ($customers instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PaymentsTableMap::COL_CUSTOMERNUMBER, $customers->toKeyValue('PrimaryKey', 'Customernumber'), $comparison);
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
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildPayments $payments Object to remove from the list of results
     *
     * @return $this|ChildPaymentsQuery The current query, for fluid interface
     */
    public function prune($payments = null)
    {
        if ($payments) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PaymentsTableMap::COL_CUSTOMERNUMBER), $payments->getCustomernumber(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PaymentsTableMap::COL_CHECKNUMBER), $payments->getChecknumber(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the payments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PaymentsTableMap::clearInstancePool();
            PaymentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PaymentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PaymentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PaymentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PaymentsQuery
