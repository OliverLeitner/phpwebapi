<?php

namespace Map;

use \Orders;
use \OrdersQuery;
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
 * This class defines the structure of the 'orders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrdersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrdersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'orders';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Orders';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Orders';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the orderNumber field
     */
    const COL_ORDERNUMBER = 'orders.orderNumber';

    /**
     * the column name for the orderDate field
     */
    const COL_ORDERDATE = 'orders.orderDate';

    /**
     * the column name for the requiredDate field
     */
    const COL_REQUIREDDATE = 'orders.requiredDate';

    /**
     * the column name for the shippedDate field
     */
    const COL_SHIPPEDDATE = 'orders.shippedDate';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'orders.status';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'orders.comments';

    /**
     * the column name for the customerNumber field
     */
    const COL_CUSTOMERNUMBER = 'orders.customerNumber';

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
        self::TYPE_PHPNAME       => array('Ordernumber', 'Orderdate', 'Requireddate', 'Shippeddate', 'Status', 'Comments', 'Customernumber', ),
        self::TYPE_CAMELNAME     => array('ordernumber', 'orderdate', 'requireddate', 'shippeddate', 'status', 'comments', 'customernumber', ),
        self::TYPE_COLNAME       => array(OrdersTableMap::COL_ORDERNUMBER, OrdersTableMap::COL_ORDERDATE, OrdersTableMap::COL_REQUIREDDATE, OrdersTableMap::COL_SHIPPEDDATE, OrdersTableMap::COL_STATUS, OrdersTableMap::COL_COMMENTS, OrdersTableMap::COL_CUSTOMERNUMBER, ),
        self::TYPE_FIELDNAME     => array('orderNumber', 'orderDate', 'requiredDate', 'shippedDate', 'status', 'comments', 'customerNumber', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Ordernumber' => 0, 'Orderdate' => 1, 'Requireddate' => 2, 'Shippeddate' => 3, 'Status' => 4, 'Comments' => 5, 'Customernumber' => 6, ),
        self::TYPE_CAMELNAME     => array('ordernumber' => 0, 'orderdate' => 1, 'requireddate' => 2, 'shippeddate' => 3, 'status' => 4, 'comments' => 5, 'customernumber' => 6, ),
        self::TYPE_COLNAME       => array(OrdersTableMap::COL_ORDERNUMBER => 0, OrdersTableMap::COL_ORDERDATE => 1, OrdersTableMap::COL_REQUIREDDATE => 2, OrdersTableMap::COL_SHIPPEDDATE => 3, OrdersTableMap::COL_STATUS => 4, OrdersTableMap::COL_COMMENTS => 5, OrdersTableMap::COL_CUSTOMERNUMBER => 6, ),
        self::TYPE_FIELDNAME     => array('orderNumber' => 0, 'orderDate' => 1, 'requiredDate' => 2, 'shippedDate' => 3, 'status' => 4, 'comments' => 5, 'customerNumber' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Ordernumber' => 'ORDERNUMBER',
        'Orders.Ordernumber' => 'ORDERNUMBER',
        'ordernumber' => 'ORDERNUMBER',
        'orders.ordernumber' => 'ORDERNUMBER',
        'OrdersTableMap::COL_ORDERNUMBER' => 'ORDERNUMBER',
        'COL_ORDERNUMBER' => 'ORDERNUMBER',
        'orderNumber' => 'ORDERNUMBER',
        'orders.orderNumber' => 'ORDERNUMBER',
        'Orderdate' => 'ORDERDATE',
        'Orders.Orderdate' => 'ORDERDATE',
        'orderdate' => 'ORDERDATE',
        'orders.orderdate' => 'ORDERDATE',
        'OrdersTableMap::COL_ORDERDATE' => 'ORDERDATE',
        'COL_ORDERDATE' => 'ORDERDATE',
        'orderDate' => 'ORDERDATE',
        'orders.orderDate' => 'ORDERDATE',
        'Requireddate' => 'REQUIREDDATE',
        'Orders.Requireddate' => 'REQUIREDDATE',
        'requireddate' => 'REQUIREDDATE',
        'orders.requireddate' => 'REQUIREDDATE',
        'OrdersTableMap::COL_REQUIREDDATE' => 'REQUIREDDATE',
        'COL_REQUIREDDATE' => 'REQUIREDDATE',
        'requiredDate' => 'REQUIREDDATE',
        'orders.requiredDate' => 'REQUIREDDATE',
        'Shippeddate' => 'SHIPPEDDATE',
        'Orders.Shippeddate' => 'SHIPPEDDATE',
        'shippeddate' => 'SHIPPEDDATE',
        'orders.shippeddate' => 'SHIPPEDDATE',
        'OrdersTableMap::COL_SHIPPEDDATE' => 'SHIPPEDDATE',
        'COL_SHIPPEDDATE' => 'SHIPPEDDATE',
        'shippedDate' => 'SHIPPEDDATE',
        'orders.shippedDate' => 'SHIPPEDDATE',
        'Status' => 'STATUS',
        'Orders.Status' => 'STATUS',
        'status' => 'STATUS',
        'orders.status' => 'STATUS',
        'OrdersTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'status' => 'STATUS',
        'orders.status' => 'STATUS',
        'Comments' => 'COMMENTS',
        'Orders.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'orders.comments' => 'COMMENTS',
        'OrdersTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'orders.comments' => 'COMMENTS',
        'Customernumber' => 'CUSTOMERNUMBER',
        'Orders.Customernumber' => 'CUSTOMERNUMBER',
        'customernumber' => 'CUSTOMERNUMBER',
        'orders.customernumber' => 'CUSTOMERNUMBER',
        'OrdersTableMap::COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'customerNumber' => 'CUSTOMERNUMBER',
        'orders.customerNumber' => 'CUSTOMERNUMBER',
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
        $this->setName('orders');
        $this->setPhpName('Orders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orders');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('orderNumber', 'Ordernumber', 'INTEGER', true, null, null);
        $this->addColumn('orderDate', 'Orderdate', 'DATE', true, null, null);
        $this->addColumn('requiredDate', 'Requireddate', 'DATE', true, null, null);
        $this->addColumn('shippedDate', 'Shippeddate', 'DATE', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 15, null);
        $this->addColumn('comments', 'Comments', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('customerNumber', 'Customernumber', 'INTEGER', 'customers', 'customerNumber', true, null, null);
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
        $this->addRelation('Orderdetails', '\\Orderdetails', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orderNumber',
    1 => ':orderNumber',
  ),
), null, null, 'Orderdetailss', false);
    } // buildRelations()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)
        ];
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
        return $withPrefix ? OrdersTableMap::CLASS_DEFAULT : OrdersTableMap::OM_CLASS;
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
     * @return array           (Orders object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrdersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrdersTableMap::OM_CLASS;
            /** @var Orders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrdersTableMap::addInstanceToPool($obj, $key);
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
            $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrdersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDERNUMBER);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDERDATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_REQUIREDDATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_SHIPPEDDATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_STATUS);
            $criteria->addSelectColumn(OrdersTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(OrdersTableMap::COL_CUSTOMERNUMBER);
        } else {
            $criteria->addSelectColumn($alias . '.orderNumber');
            $criteria->addSelectColumn($alias . '.orderDate');
            $criteria->addSelectColumn($alias . '.requiredDate');
            $criteria->addSelectColumn($alias . '.shippedDate');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.customerNumber');
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
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDERNUMBER);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDERDATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_REQUIREDDATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_SHIPPEDDATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_STATUS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_CUSTOMERNUMBER);
        } else {
            $criteria->removeSelectColumn($alias . '.orderNumber');
            $criteria->removeSelectColumn($alias . '.orderDate');
            $criteria->removeSelectColumn($alias . '.requiredDate');
            $criteria->removeSelectColumn($alias . '.shippedDate');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.customerNumber');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrdersTableMap::DATABASE_NAME)->getTable(OrdersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OrdersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OrdersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OrdersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Orders or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Orders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);
            $criteria->add(OrdersTableMap::COL_ORDERNUMBER, (array) $values, Criteria::IN);
        }

        $query = OrdersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrdersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrdersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrdersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orders or Criteria object.
     *
     * @param mixed               $criteria Criteria or Orders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orders object
        }


        // Set the correct dbName
        $query = OrdersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrdersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OrdersTableMap::buildTableMap();
