<?php

namespace Map;

use \Employees;
use \EmployeesQuery;
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
 * This class defines the structure of the 'employees' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.EmployeesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employees';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Employees';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Employees';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the employeeNumber field
     */
    const COL_EMPLOYEENUMBER = 'employees.employeeNumber';

    /**
     * the column name for the lastName field
     */
    const COL_LASTNAME = 'employees.lastName';

    /**
     * the column name for the firstName field
     */
    const COL_FIRSTNAME = 'employees.firstName';

    /**
     * the column name for the extension field
     */
    const COL_EXTENSION = 'employees.extension';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'employees.email';

    /**
     * the column name for the officeCode field
     */
    const COL_OFFICECODE = 'employees.officeCode';

    /**
     * the column name for the reportsTo field
     */
    const COL_REPORTSTO = 'employees.reportsTo';

    /**
     * the column name for the jobTitle field
     */
    const COL_JOBTITLE = 'employees.jobTitle';

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
        self::TYPE_PHPNAME       => array('Employeenumber', 'Lastname', 'Firstname', 'Extension', 'Email', 'Officecode', 'Reportsto', 'Jobtitle', ),
        self::TYPE_CAMELNAME     => array('employeenumber', 'lastname', 'firstname', 'extension', 'email', 'officecode', 'reportsto', 'jobtitle', ),
        self::TYPE_COLNAME       => array(EmployeesTableMap::COL_EMPLOYEENUMBER, EmployeesTableMap::COL_LASTNAME, EmployeesTableMap::COL_FIRSTNAME, EmployeesTableMap::COL_EXTENSION, EmployeesTableMap::COL_EMAIL, EmployeesTableMap::COL_OFFICECODE, EmployeesTableMap::COL_REPORTSTO, EmployeesTableMap::COL_JOBTITLE, ),
        self::TYPE_FIELDNAME     => array('employeeNumber', 'lastName', 'firstName', 'extension', 'email', 'officeCode', 'reportsTo', 'jobTitle', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Employeenumber' => 0, 'Lastname' => 1, 'Firstname' => 2, 'Extension' => 3, 'Email' => 4, 'Officecode' => 5, 'Reportsto' => 6, 'Jobtitle' => 7, ),
        self::TYPE_CAMELNAME     => array('employeenumber' => 0, 'lastname' => 1, 'firstname' => 2, 'extension' => 3, 'email' => 4, 'officecode' => 5, 'reportsto' => 6, 'jobtitle' => 7, ),
        self::TYPE_COLNAME       => array(EmployeesTableMap::COL_EMPLOYEENUMBER => 0, EmployeesTableMap::COL_LASTNAME => 1, EmployeesTableMap::COL_FIRSTNAME => 2, EmployeesTableMap::COL_EXTENSION => 3, EmployeesTableMap::COL_EMAIL => 4, EmployeesTableMap::COL_OFFICECODE => 5, EmployeesTableMap::COL_REPORTSTO => 6, EmployeesTableMap::COL_JOBTITLE => 7, ),
        self::TYPE_FIELDNAME     => array('employeeNumber' => 0, 'lastName' => 1, 'firstName' => 2, 'extension' => 3, 'email' => 4, 'officeCode' => 5, 'reportsTo' => 6, 'jobTitle' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Employeenumber' => 'EMPLOYEENUMBER',
        'Employees.Employeenumber' => 'EMPLOYEENUMBER',
        'employeenumber' => 'EMPLOYEENUMBER',
        'employees.employeenumber' => 'EMPLOYEENUMBER',
        'EmployeesTableMap::COL_EMPLOYEENUMBER' => 'EMPLOYEENUMBER',
        'COL_EMPLOYEENUMBER' => 'EMPLOYEENUMBER',
        'employeeNumber' => 'EMPLOYEENUMBER',
        'employees.employeeNumber' => 'EMPLOYEENUMBER',
        'Lastname' => 'LASTNAME',
        'Employees.Lastname' => 'LASTNAME',
        'lastname' => 'LASTNAME',
        'employees.lastname' => 'LASTNAME',
        'EmployeesTableMap::COL_LASTNAME' => 'LASTNAME',
        'COL_LASTNAME' => 'LASTNAME',
        'lastName' => 'LASTNAME',
        'employees.lastName' => 'LASTNAME',
        'Firstname' => 'FIRSTNAME',
        'Employees.Firstname' => 'FIRSTNAME',
        'firstname' => 'FIRSTNAME',
        'employees.firstname' => 'FIRSTNAME',
        'EmployeesTableMap::COL_FIRSTNAME' => 'FIRSTNAME',
        'COL_FIRSTNAME' => 'FIRSTNAME',
        'firstName' => 'FIRSTNAME',
        'employees.firstName' => 'FIRSTNAME',
        'Extension' => 'EXTENSION',
        'Employees.Extension' => 'EXTENSION',
        'extension' => 'EXTENSION',
        'employees.extension' => 'EXTENSION',
        'EmployeesTableMap::COL_EXTENSION' => 'EXTENSION',
        'COL_EXTENSION' => 'EXTENSION',
        'extension' => 'EXTENSION',
        'employees.extension' => 'EXTENSION',
        'Email' => 'EMAIL',
        'Employees.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'employees.email' => 'EMAIL',
        'EmployeesTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'email' => 'EMAIL',
        'employees.email' => 'EMAIL',
        'Officecode' => 'OFFICECODE',
        'Employees.Officecode' => 'OFFICECODE',
        'officecode' => 'OFFICECODE',
        'employees.officecode' => 'OFFICECODE',
        'EmployeesTableMap::COL_OFFICECODE' => 'OFFICECODE',
        'COL_OFFICECODE' => 'OFFICECODE',
        'officeCode' => 'OFFICECODE',
        'employees.officeCode' => 'OFFICECODE',
        'Reportsto' => 'REPORTSTO',
        'Employees.Reportsto' => 'REPORTSTO',
        'reportsto' => 'REPORTSTO',
        'employees.reportsto' => 'REPORTSTO',
        'EmployeesTableMap::COL_REPORTSTO' => 'REPORTSTO',
        'COL_REPORTSTO' => 'REPORTSTO',
        'reportsTo' => 'REPORTSTO',
        'employees.reportsTo' => 'REPORTSTO',
        'Jobtitle' => 'JOBTITLE',
        'Employees.Jobtitle' => 'JOBTITLE',
        'jobtitle' => 'JOBTITLE',
        'employees.jobtitle' => 'JOBTITLE',
        'EmployeesTableMap::COL_JOBTITLE' => 'JOBTITLE',
        'COL_JOBTITLE' => 'JOBTITLE',
        'jobTitle' => 'JOBTITLE',
        'employees.jobTitle' => 'JOBTITLE',
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
        $this->setName('employees');
        $this->setPhpName('Employees');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Employees');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('employeeNumber', 'Employeenumber', 'INTEGER', true, null, null);
        $this->addColumn('lastName', 'Lastname', 'VARCHAR', true, 50, null);
        $this->addColumn('firstName', 'Firstname', 'VARCHAR', true, 50, null);
        $this->addColumn('extension', 'Extension', 'VARCHAR', true, 10, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 100, null);
        $this->addForeignKey('officeCode', 'Officecode', 'VARCHAR', 'offices', 'officeCode', true, 10, null);
        $this->addForeignKey('reportsTo', 'Reportsto', 'INTEGER', 'employees', 'employeeNumber', false, null, null);
        $this->addColumn('jobTitle', 'Jobtitle', 'VARCHAR', true, 50, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('EmployeesRelatedByReportsto', '\\Employees', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':reportsTo',
    1 => ':employeeNumber',
  ),
), null, null, null, false);
        $this->addRelation('Offices', '\\Offices', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':officeCode',
    1 => ':officeCode',
  ),
), null, null, null, false);
        $this->addRelation('Customers', '\\Customers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':salesRepEmployeeNumber',
    1 => ':employeeNumber',
  ),
), null, null, 'Customerss', false);
        $this->addRelation('EmployeesRelatedByEmployeenumber', '\\Employees', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':reportsTo',
    1 => ':employeeNumber',
  ),
), null, null, 'EmployeessRelatedByEmployeenumber', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Employeenumber', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeesTableMap::CLASS_DEFAULT : EmployeesTableMap::OM_CLASS;
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
     * @return array           (Employees object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeesTableMap::OM_CLASS;
            /** @var Employees $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeesTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employees $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEENUMBER);
            $criteria->addSelectColumn(EmployeesTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(EmployeesTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EXTENSION);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMAIL);
            $criteria->addSelectColumn(EmployeesTableMap::COL_OFFICECODE);
            $criteria->addSelectColumn(EmployeesTableMap::COL_REPORTSTO);
            $criteria->addSelectColumn(EmployeesTableMap::COL_JOBTITLE);
        } else {
            $criteria->addSelectColumn($alias . '.employeeNumber');
            $criteria->addSelectColumn($alias . '.lastName');
            $criteria->addSelectColumn($alias . '.firstName');
            $criteria->addSelectColumn($alias . '.extension');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.officeCode');
            $criteria->addSelectColumn($alias . '.reportsTo');
            $criteria->addSelectColumn($alias . '.jobTitle');
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
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEENUMBER);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_LASTNAME);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_FIRSTNAME);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EXTENSION);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_OFFICECODE);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_REPORTSTO);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_JOBTITLE);
        } else {
            $criteria->removeSelectColumn($alias . '.employeeNumber');
            $criteria->removeSelectColumn($alias . '.lastName');
            $criteria->removeSelectColumn($alias . '.firstName');
            $criteria->removeSelectColumn($alias . '.extension');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.officeCode');
            $criteria->removeSelectColumn($alias . '.reportsTo');
            $criteria->removeSelectColumn($alias . '.jobTitle');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeesTableMap::DATABASE_NAME)->getTable(EmployeesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmployeesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmployeesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmployeesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Employees or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employees object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Employees) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeesTableMap::DATABASE_NAME);
            $criteria->add(EmployeesTableMap::COL_EMPLOYEENUMBER, (array) $values, Criteria::IN);
        }

        $query = EmployeesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employees or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employees object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employees object
        }


        // Set the correct dbName
        $query = EmployeesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmployeesTableMap::buildTableMap();
