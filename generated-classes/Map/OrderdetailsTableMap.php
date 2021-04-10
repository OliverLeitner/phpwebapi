<?php

namespace Map;

use \Orderdetails;
use \OrderdetailsQuery;
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
 * This class defines the structure of the 'orderdetails' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderdetailsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderdetailsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'orderdetails';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Orderdetails';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Orderdetails';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the orderNumber field
     */
    const COL_ORDERNUMBER = 'orderdetails.orderNumber';

    /**
     * the column name for the productCode field
     */
    const COL_PRODUCTCODE = 'orderdetails.productCode';

    /**
     * the column name for the quantityOrdered field
     */
    const COL_QUANTITYORDERED = 'orderdetails.quantityOrdered';

    /**
     * the column name for the priceEach field
     */
    const COL_PRICEEACH = 'orderdetails.priceEach';

    /**
     * the column name for the orderLineNumber field
     */
    const COL_ORDERLINENUMBER = 'orderdetails.orderLineNumber';

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
        self::TYPE_PHPNAME       => array('Ordernumber', 'Productcode', 'Quantityordered', 'Priceeach', 'Orderlinenumber', ),
        self::TYPE_CAMELNAME     => array('ordernumber', 'productcode', 'quantityordered', 'priceeach', 'orderlinenumber', ),
        self::TYPE_COLNAME       => array(OrderdetailsTableMap::COL_ORDERNUMBER, OrderdetailsTableMap::COL_PRODUCTCODE, OrderdetailsTableMap::COL_QUANTITYORDERED, OrderdetailsTableMap::COL_PRICEEACH, OrderdetailsTableMap::COL_ORDERLINENUMBER, ),
        self::TYPE_FIELDNAME     => array('orderNumber', 'productCode', 'quantityOrdered', 'priceEach', 'orderLineNumber', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Ordernumber' => 0, 'Productcode' => 1, 'Quantityordered' => 2, 'Priceeach' => 3, 'Orderlinenumber' => 4, ),
        self::TYPE_CAMELNAME     => array('ordernumber' => 0, 'productcode' => 1, 'quantityordered' => 2, 'priceeach' => 3, 'orderlinenumber' => 4, ),
        self::TYPE_COLNAME       => array(OrderdetailsTableMap::COL_ORDERNUMBER => 0, OrderdetailsTableMap::COL_PRODUCTCODE => 1, OrderdetailsTableMap::COL_QUANTITYORDERED => 2, OrderdetailsTableMap::COL_PRICEEACH => 3, OrderdetailsTableMap::COL_ORDERLINENUMBER => 4, ),
        self::TYPE_FIELDNAME     => array('orderNumber' => 0, 'productCode' => 1, 'quantityOrdered' => 2, 'priceEach' => 3, 'orderLineNumber' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Ordernumber' => 'ORDERNUMBER',
        'Orderdetails.Ordernumber' => 'ORDERNUMBER',
        'ordernumber' => 'ORDERNUMBER',
        'orderdetails.ordernumber' => 'ORDERNUMBER',
        'OrderdetailsTableMap::COL_ORDERNUMBER' => 'ORDERNUMBER',
        'COL_ORDERNUMBER' => 'ORDERNUMBER',
        'orderNumber' => 'ORDERNUMBER',
        'orderdetails.orderNumber' => 'ORDERNUMBER',
        'Productcode' => 'PRODUCTCODE',
        'Orderdetails.Productcode' => 'PRODUCTCODE',
        'productcode' => 'PRODUCTCODE',
        'orderdetails.productcode' => 'PRODUCTCODE',
        'OrderdetailsTableMap::COL_PRODUCTCODE' => 'PRODUCTCODE',
        'COL_PRODUCTCODE' => 'PRODUCTCODE',
        'productCode' => 'PRODUCTCODE',
        'orderdetails.productCode' => 'PRODUCTCODE',
        'Quantityordered' => 'QUANTITYORDERED',
        'Orderdetails.Quantityordered' => 'QUANTITYORDERED',
        'quantityordered' => 'QUANTITYORDERED',
        'orderdetails.quantityordered' => 'QUANTITYORDERED',
        'OrderdetailsTableMap::COL_QUANTITYORDERED' => 'QUANTITYORDERED',
        'COL_QUANTITYORDERED' => 'QUANTITYORDERED',
        'quantityOrdered' => 'QUANTITYORDERED',
        'orderdetails.quantityOrdered' => 'QUANTITYORDERED',
        'Priceeach' => 'PRICEEACH',
        'Orderdetails.Priceeach' => 'PRICEEACH',
        'priceeach' => 'PRICEEACH',
        'orderdetails.priceeach' => 'PRICEEACH',
        'OrderdetailsTableMap::COL_PRICEEACH' => 'PRICEEACH',
        'COL_PRICEEACH' => 'PRICEEACH',
        'priceEach' => 'PRICEEACH',
        'orderdetails.priceEach' => 'PRICEEACH',
        'Orderlinenumber' => 'ORDERLINENUMBER',
        'Orderdetails.Orderlinenumber' => 'ORDERLINENUMBER',
        'orderlinenumber' => 'ORDERLINENUMBER',
        'orderdetails.orderlinenumber' => 'ORDERLINENUMBER',
        'OrderdetailsTableMap::COL_ORDERLINENUMBER' => 'ORDERLINENUMBER',
        'COL_ORDERLINENUMBER' => 'ORDERLINENUMBER',
        'orderLineNumber' => 'ORDERLINENUMBER',
        'orderdetails.orderLineNumber' => 'ORDERLINENUMBER',
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
        $this->setName('orderdetails');
        $this->setPhpName('Orderdetails');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orderdetails');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('orderNumber', 'Ordernumber', 'INTEGER' , 'orders', 'orderNumber', true, null, null);
        $this->addForeignPrimaryKey('productCode', 'Productcode', 'VARCHAR' , 'products', 'productCode', true, 15, null);
        $this->addColumn('quantityOrdered', 'Quantityordered', 'INTEGER', true, null, null);
        $this->addColumn('priceEach', 'Priceeach', 'DECIMAL', true, 10, null);
        $this->addColumn('orderLineNumber', 'Orderlinenumber', 'SMALLINT', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Orders', '\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orderNumber',
    1 => ':orderNumber',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':productCode',
    1 => ':productCode',
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
     * @param \Orderdetails $obj A \Orderdetails object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getOrdernumber() || is_scalar($obj->getOrdernumber()) || is_callable([$obj->getOrdernumber(), '__toString']) ? (string) $obj->getOrdernumber() : $obj->getOrdernumber()), (null === $obj->getProductcode() || is_scalar($obj->getProductcode()) || is_callable([$obj->getProductcode(), '__toString']) ? (string) $obj->getProductcode() : $obj->getProductcode())]);
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
     * @param mixed $value A \Orderdetails object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Orderdetails) {
                $key = serialize([(null === $value->getOrdernumber() || is_scalar($value->getOrdernumber()) || is_callable([$value->getOrdernumber(), '__toString']) ? (string) $value->getOrdernumber() : $value->getOrdernumber()), (null === $value->getProductcode() || is_scalar($value->getProductcode()) || is_callable([$value->getProductcode(), '__toString']) ? (string) $value->getProductcode() : $value->getProductcode())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Orderdetails object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                : self::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OrderdetailsTableMap::CLASS_DEFAULT : OrderdetailsTableMap::OM_CLASS;
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
     * @return array           (Orderdetails object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderdetailsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderdetailsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderdetailsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderdetailsTableMap::OM_CLASS;
            /** @var Orderdetails $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderdetailsTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderdetailsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderdetailsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orderdetails $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderdetailsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderdetailsTableMap::COL_ORDERNUMBER);
            $criteria->addSelectColumn(OrderdetailsTableMap::COL_PRODUCTCODE);
            $criteria->addSelectColumn(OrderdetailsTableMap::COL_QUANTITYORDERED);
            $criteria->addSelectColumn(OrderdetailsTableMap::COL_PRICEEACH);
            $criteria->addSelectColumn(OrderdetailsTableMap::COL_ORDERLINENUMBER);
        } else {
            $criteria->addSelectColumn($alias . '.orderNumber');
            $criteria->addSelectColumn($alias . '.productCode');
            $criteria->addSelectColumn($alias . '.quantityOrdered');
            $criteria->addSelectColumn($alias . '.priceEach');
            $criteria->addSelectColumn($alias . '.orderLineNumber');
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
            $criteria->removeSelectColumn(OrderdetailsTableMap::COL_ORDERNUMBER);
            $criteria->removeSelectColumn(OrderdetailsTableMap::COL_PRODUCTCODE);
            $criteria->removeSelectColumn(OrderdetailsTableMap::COL_QUANTITYORDERED);
            $criteria->removeSelectColumn(OrderdetailsTableMap::COL_PRICEEACH);
            $criteria->removeSelectColumn(OrderdetailsTableMap::COL_ORDERLINENUMBER);
        } else {
            $criteria->removeSelectColumn($alias . '.orderNumber');
            $criteria->removeSelectColumn($alias . '.productCode');
            $criteria->removeSelectColumn($alias . '.quantityOrdered');
            $criteria->removeSelectColumn($alias . '.priceEach');
            $criteria->removeSelectColumn($alias . '.orderLineNumber');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderdetailsTableMap::DATABASE_NAME)->getTable(OrderdetailsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OrderdetailsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OrderdetailsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OrderdetailsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Orderdetails or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Orderdetails object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderdetailsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orderdetails) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderdetailsTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(OrderdetailsTableMap::COL_ORDERNUMBER, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(OrderdetailsTableMap::COL_PRODUCTCODE, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = OrderdetailsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderdetailsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderdetailsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orderdetails table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderdetailsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orderdetails or Criteria object.
     *
     * @param mixed               $criteria Criteria or Orderdetails object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderdetailsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orderdetails object
        }


        // Set the correct dbName
        $query = OrderdetailsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderdetailsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OrderdetailsTableMap::buildTableMap();
