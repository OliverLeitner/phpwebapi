<?php

namespace Map;

use \Payments;
use \PaymentsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'payments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PaymentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PaymentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'payments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Payments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Payments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the customerNumber field
     */
    const COL_CUSTOMERNUMBER = 'payments.customerNumber';

    /**
     * the column name for the checkNumber field
     */
    const COL_CHECKNUMBER = 'payments.checkNumber';

    /**
     * the column name for the paymentDate field
     */
    const COL_PAYMENTDATE = 'payments.paymentDate';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'payments.amount';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Customernumber', 'Checknumber', 'Paymentdate', 'Amount', ),
        self::TYPE_CAMELNAME     => array('customernumber', 'checknumber', 'paymentdate', 'amount', ),
        self::TYPE_COLNAME       => array(PaymentsTableMap::COL_CUSTOMERNUMBER, PaymentsTableMap::COL_CHECKNUMBER, PaymentsTableMap::COL_PAYMENTDATE, PaymentsTableMap::COL_AMOUNT, ),
        self::TYPE_FIELDNAME     => array('customerNumber', 'checkNumber', 'paymentDate', 'amount', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Customernumber' => 0, 'Checknumber' => 1, 'Paymentdate' => 2, 'Amount' => 3, ),
        self::TYPE_CAMELNAME     => array('customernumber' => 0, 'checknumber' => 1, 'paymentdate' => 2, 'amount' => 3, ),
        self::TYPE_COLNAME       => array(PaymentsTableMap::COL_CUSTOMERNUMBER => 0, PaymentsTableMap::COL_CHECKNUMBER => 1, PaymentsTableMap::COL_PAYMENTDATE => 2, PaymentsTableMap::COL_AMOUNT => 3, ),
        self::TYPE_FIELDNAME     => array('customerNumber' => 0, 'checkNumber' => 1, 'paymentDate' => 2, 'amount' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Customernumber' => 'CUSTOMERNUMBER',
        'Payments.Customernumber' => 'CUSTOMERNUMBER',
        'customernumber' => 'CUSTOMERNUMBER',
        'payments.customernumber' => 'CUSTOMERNUMBER',
        'PaymentsTableMap::COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'customerNumber' => 'CUSTOMERNUMBER',
        'payments.customerNumber' => 'CUSTOMERNUMBER',
        'Checknumber' => 'CHECKNUMBER',
        'Payments.Checknumber' => 'CHECKNUMBER',
        'checknumber' => 'CHECKNUMBER',
        'payments.checknumber' => 'CHECKNUMBER',
        'PaymentsTableMap::COL_CHECKNUMBER' => 'CHECKNUMBER',
        'COL_CHECKNUMBER' => 'CHECKNUMBER',
        'checkNumber' => 'CHECKNUMBER',
        'payments.checkNumber' => 'CHECKNUMBER',
        'Paymentdate' => 'PAYMENTDATE',
        'Payments.Paymentdate' => 'PAYMENTDATE',
        'paymentdate' => 'PAYMENTDATE',
        'payments.paymentdate' => 'PAYMENTDATE',
        'PaymentsTableMap::COL_PAYMENTDATE' => 'PAYMENTDATE',
        'COL_PAYMENTDATE' => 'PAYMENTDATE',
        'paymentDate' => 'PAYMENTDATE',
        'payments.paymentDate' => 'PAYMENTDATE',
        'Amount' => 'AMOUNT',
        'Payments.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'payments.amount' => 'AMOUNT',
        'PaymentsTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'payments.amount' => 'AMOUNT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('payments');
        $this->setPhpName('Payments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Payments');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('customerNumber', 'Customernumber', 'INTEGER' , 'customers', 'customerNumber', true, null, null);
        $this->addPrimaryKey('checkNumber', 'Checknumber', 'VARCHAR', true, 50, null);
        $this->addColumn('paymentDate', 'Paymentdate', 'DATE', true, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customers', '\\Customers', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':customerNumber',
    1 => ':customerNumber',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Payments $obj A \Payments object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getCustomernumber() || is_scalar($obj->getCustomernumber()) || is_callable([$obj->getCustomernumber(), '__toString']) ? (string) $obj->getCustomernumber() : $obj->getCustomernumber()), (null === $obj->getChecknumber() || is_scalar($obj->getChecknumber()) || is_callable([$obj->getChecknumber(), '__toString']) ? (string) $obj->getChecknumber() : $obj->getChecknumber())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Payments object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Payments) {
                $key = serialize([(null === $value->getCustomernumber() || is_scalar($value->getCustomernumber()) || is_callable([$value->getCustomernumber(), '__toString']) ? (string) $value->getCustomernumber() : $value->getCustomernumber()), (null === $value->getChecknumber() || is_scalar($value->getChecknumber()) || is_callable([$value->getChecknumber(), '__toString']) ? (string) $value->getChecknumber() : $value->getChecknumber())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Payments object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Checknumber', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PaymentsTableMap::CLASS_DEFAULT : PaymentsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Payments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PaymentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PaymentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PaymentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PaymentsTableMap::OM_CLASS;
            /** @var Payments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PaymentsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PaymentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PaymentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Payments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PaymentsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PaymentsTableMap::COL_CUSTOMERNUMBER);
            $criteria->addSelectColumn(PaymentsTableMap::COL_CHECKNUMBER);
            $criteria->addSelectColumn(PaymentsTableMap::COL_PAYMENTDATE);
            $criteria->addSelectColumn(PaymentsTableMap::COL_AMOUNT);
        } else {
            $criteria->addSelectColumn($alias . '.customerNumber');
            $criteria->addSelectColumn($alias . '.checkNumber');
            $criteria->addSelectColumn($alias . '.paymentDate');
            $criteria->addSelectColumn($alias . '.amount');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PaymentsTableMap::COL_CUSTOMERNUMBER);
            $criteria->removeSelectColumn(PaymentsTableMap::COL_CHECKNUMBER);
            $criteria->removeSelectColumn(PaymentsTableMap::COL_PAYMENTDATE);
            $criteria->removeSelectColumn(PaymentsTableMap::COL_AMOUNT);
        } else {
            $criteria->removeSelectColumn($alias . '.customerNumber');
            $criteria->removeSelectColumn($alias . '.checkNumber');
            $criteria->removeSelectColumn($alias . '.paymentDate');
            $criteria->removeSelectColumn($alias . '.amount');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PaymentsTableMap::DATABASE_NAME)->getTable(PaymentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PaymentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PaymentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PaymentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Payments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Payments object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Payments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PaymentsTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(PaymentsTableMap::COL_CUSTOMERNUMBER, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(PaymentsTableMap::COL_CHECKNUMBER, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = PaymentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PaymentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PaymentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the payments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PaymentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Payments or Criteria object.
     *
     * @param mixed               $criteria Criteria or Payments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Payments object
        }


        // Set the correct dbName
        $query = PaymentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PaymentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PaymentsTableMap::buildTableMap();
