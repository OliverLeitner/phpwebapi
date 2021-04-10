<?php

namespace Map;

use \Offices;
use \OfficesQuery;
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
 * This class defines the structure of the 'offices' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OfficesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OfficesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'offices';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Offices';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Offices';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the officeCode field
     */
    const COL_OFFICECODE = 'offices.officeCode';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'offices.city';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'offices.phone';

    /**
     * the column name for the addressLine1 field
     */
    const COL_ADDRESSLINE1 = 'offices.addressLine1';

    /**
     * the column name for the addressLine2 field
     */
    const COL_ADDRESSLINE2 = 'offices.addressLine2';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'offices.state';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'offices.country';

    /**
     * the column name for the postalCode field
     */
    const COL_POSTALCODE = 'offices.postalCode';

    /**
     * the column name for the territory field
     */
    const COL_TERRITORY = 'offices.territory';

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
        self::TYPE_PHPNAME       => array('Officecode', 'City', 'Phone', 'Addressline1', 'Addressline2', 'State', 'Country', 'Postalcode', 'Territory', ),
        self::TYPE_CAMELNAME     => array('officecode', 'city', 'phone', 'addressline1', 'addressline2', 'state', 'country', 'postalcode', 'territory', ),
        self::TYPE_COLNAME       => array(OfficesTableMap::COL_OFFICECODE, OfficesTableMap::COL_CITY, OfficesTableMap::COL_PHONE, OfficesTableMap::COL_ADDRESSLINE1, OfficesTableMap::COL_ADDRESSLINE2, OfficesTableMap::COL_STATE, OfficesTableMap::COL_COUNTRY, OfficesTableMap::COL_POSTALCODE, OfficesTableMap::COL_TERRITORY, ),
        self::TYPE_FIELDNAME     => array('officeCode', 'city', 'phone', 'addressLine1', 'addressLine2', 'state', 'country', 'postalCode', 'territory', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Officecode' => 0, 'City' => 1, 'Phone' => 2, 'Addressline1' => 3, 'Addressline2' => 4, 'State' => 5, 'Country' => 6, 'Postalcode' => 7, 'Territory' => 8, ),
        self::TYPE_CAMELNAME     => array('officecode' => 0, 'city' => 1, 'phone' => 2, 'addressline1' => 3, 'addressline2' => 4, 'state' => 5, 'country' => 6, 'postalcode' => 7, 'territory' => 8, ),
        self::TYPE_COLNAME       => array(OfficesTableMap::COL_OFFICECODE => 0, OfficesTableMap::COL_CITY => 1, OfficesTableMap::COL_PHONE => 2, OfficesTableMap::COL_ADDRESSLINE1 => 3, OfficesTableMap::COL_ADDRESSLINE2 => 4, OfficesTableMap::COL_STATE => 5, OfficesTableMap::COL_COUNTRY => 6, OfficesTableMap::COL_POSTALCODE => 7, OfficesTableMap::COL_TERRITORY => 8, ),
        self::TYPE_FIELDNAME     => array('officeCode' => 0, 'city' => 1, 'phone' => 2, 'addressLine1' => 3, 'addressLine2' => 4, 'state' => 5, 'country' => 6, 'postalCode' => 7, 'territory' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Officecode' => 'OFFICECODE',
        'Offices.Officecode' => 'OFFICECODE',
        'officecode' => 'OFFICECODE',
        'offices.officecode' => 'OFFICECODE',
        'OfficesTableMap::COL_OFFICECODE' => 'OFFICECODE',
        'COL_OFFICECODE' => 'OFFICECODE',
        'officeCode' => 'OFFICECODE',
        'offices.officeCode' => 'OFFICECODE',
        'City' => 'CITY',
        'Offices.City' => 'CITY',
        'city' => 'CITY',
        'offices.city' => 'CITY',
        'OfficesTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'city' => 'CITY',
        'offices.city' => 'CITY',
        'Phone' => 'PHONE',
        'Offices.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'offices.phone' => 'PHONE',
        'OfficesTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'phone' => 'PHONE',
        'offices.phone' => 'PHONE',
        'Addressline1' => 'ADDRESSLINE1',
        'Offices.Addressline1' => 'ADDRESSLINE1',
        'addressline1' => 'ADDRESSLINE1',
        'offices.addressline1' => 'ADDRESSLINE1',
        'OfficesTableMap::COL_ADDRESSLINE1' => 'ADDRESSLINE1',
        'COL_ADDRESSLINE1' => 'ADDRESSLINE1',
        'addressLine1' => 'ADDRESSLINE1',
        'offices.addressLine1' => 'ADDRESSLINE1',
        'Addressline2' => 'ADDRESSLINE2',
        'Offices.Addressline2' => 'ADDRESSLINE2',
        'addressline2' => 'ADDRESSLINE2',
        'offices.addressline2' => 'ADDRESSLINE2',
        'OfficesTableMap::COL_ADDRESSLINE2' => 'ADDRESSLINE2',
        'COL_ADDRESSLINE2' => 'ADDRESSLINE2',
        'addressLine2' => 'ADDRESSLINE2',
        'offices.addressLine2' => 'ADDRESSLINE2',
        'State' => 'STATE',
        'Offices.State' => 'STATE',
        'state' => 'STATE',
        'offices.state' => 'STATE',
        'OfficesTableMap::COL_STATE' => 'STATE',
        'COL_STATE' => 'STATE',
        'state' => 'STATE',
        'offices.state' => 'STATE',
        'Country' => 'COUNTRY',
        'Offices.Country' => 'COUNTRY',
        'country' => 'COUNTRY',
        'offices.country' => 'COUNTRY',
        'OfficesTableMap::COL_COUNTRY' => 'COUNTRY',
        'COL_COUNTRY' => 'COUNTRY',
        'country' => 'COUNTRY',
        'offices.country' => 'COUNTRY',
        'Postalcode' => 'POSTALCODE',
        'Offices.Postalcode' => 'POSTALCODE',
        'postalcode' => 'POSTALCODE',
        'offices.postalcode' => 'POSTALCODE',
        'OfficesTableMap::COL_POSTALCODE' => 'POSTALCODE',
        'COL_POSTALCODE' => 'POSTALCODE',
        'postalCode' => 'POSTALCODE',
        'offices.postalCode' => 'POSTALCODE',
        'Territory' => 'TERRITORY',
        'Offices.Territory' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'offices.territory' => 'TERRITORY',
        'OfficesTableMap::COL_TERRITORY' => 'TERRITORY',
        'COL_TERRITORY' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'offices.territory' => 'TERRITORY',
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
        $this->setName('offices');
        $this->setPhpName('Offices');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Offices');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('officeCode', 'Officecode', 'VARCHAR', true, 10, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 50, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 50, null);
        $this->addColumn('addressLine1', 'Addressline1', 'VARCHAR', true, 50, null);
        $this->addColumn('addressLine2', 'Addressline2', 'VARCHAR', false, 50, null);
        $this->addColumn('state', 'State', 'VARCHAR', false, 50, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 50, null);
        $this->addColumn('postalCode', 'Postalcode', 'VARCHAR', true, 15, null);
        $this->addColumn('territory', 'Territory', 'VARCHAR', true, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Employees', '\\Employees', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':officeCode',
    1 => ':officeCode',
  ),
), null, null, 'Employeess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OfficesTableMap::CLASS_DEFAULT : OfficesTableMap::OM_CLASS;
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
     * @return array           (Offices object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OfficesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OfficesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OfficesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OfficesTableMap::OM_CLASS;
            /** @var Offices $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OfficesTableMap::addInstanceToPool($obj, $key);
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
            $key = OfficesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OfficesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Offices $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OfficesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OfficesTableMap::COL_OFFICECODE);
            $criteria->addSelectColumn(OfficesTableMap::COL_CITY);
            $criteria->addSelectColumn(OfficesTableMap::COL_PHONE);
            $criteria->addSelectColumn(OfficesTableMap::COL_ADDRESSLINE1);
            $criteria->addSelectColumn(OfficesTableMap::COL_ADDRESSLINE2);
            $criteria->addSelectColumn(OfficesTableMap::COL_STATE);
            $criteria->addSelectColumn(OfficesTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(OfficesTableMap::COL_POSTALCODE);
            $criteria->addSelectColumn(OfficesTableMap::COL_TERRITORY);
        } else {
            $criteria->addSelectColumn($alias . '.officeCode');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.addressLine1');
            $criteria->addSelectColumn($alias . '.addressLine2');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.postalCode');
            $criteria->addSelectColumn($alias . '.territory');
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
            $criteria->removeSelectColumn(OfficesTableMap::COL_OFFICECODE);
            $criteria->removeSelectColumn(OfficesTableMap::COL_CITY);
            $criteria->removeSelectColumn(OfficesTableMap::COL_PHONE);
            $criteria->removeSelectColumn(OfficesTableMap::COL_ADDRESSLINE1);
            $criteria->removeSelectColumn(OfficesTableMap::COL_ADDRESSLINE2);
            $criteria->removeSelectColumn(OfficesTableMap::COL_STATE);
            $criteria->removeSelectColumn(OfficesTableMap::COL_COUNTRY);
            $criteria->removeSelectColumn(OfficesTableMap::COL_POSTALCODE);
            $criteria->removeSelectColumn(OfficesTableMap::COL_TERRITORY);
        } else {
            $criteria->removeSelectColumn($alias . '.officeCode');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.addressLine1');
            $criteria->removeSelectColumn($alias . '.addressLine2');
            $criteria->removeSelectColumn($alias . '.state');
            $criteria->removeSelectColumn($alias . '.country');
            $criteria->removeSelectColumn($alias . '.postalCode');
            $criteria->removeSelectColumn($alias . '.territory');
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
        return Propel::getServiceContainer()->getDatabaseMap(OfficesTableMap::DATABASE_NAME)->getTable(OfficesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OfficesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OfficesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OfficesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Offices or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Offices object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Offices) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OfficesTableMap::DATABASE_NAME);
            $criteria->add(OfficesTableMap::COL_OFFICECODE, (array) $values, Criteria::IN);
        }

        $query = OfficesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OfficesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OfficesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the offices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OfficesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Offices or Criteria object.
     *
     * @param mixed               $criteria Criteria or Offices object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Offices object
        }


        // Set the correct dbName
        $query = OfficesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OfficesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OfficesTableMap::buildTableMap();
