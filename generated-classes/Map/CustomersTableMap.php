<?php

namespace Map;

use \Customers;
use \CustomersQuery;
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
 * This class defines the structure of the 'customers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CustomersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CustomersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'customers';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Customers';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Customers';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the customerNumber field
     */
    const COL_CUSTOMERNUMBER = 'customers.customerNumber';

    /**
     * the column name for the customerName field
     */
    const COL_CUSTOMERNAME = 'customers.customerName';

    /**
     * the column name for the contactLastName field
     */
    const COL_CONTACTLASTNAME = 'customers.contactLastName';

    /**
     * the column name for the contactFirstName field
     */
    const COL_CONTACTFIRSTNAME = 'customers.contactFirstName';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'customers.phone';

    /**
     * the column name for the addressLine1 field
     */
    const COL_ADDRESSLINE1 = 'customers.addressLine1';

    /**
     * the column name for the addressLine2 field
     */
    const COL_ADDRESSLINE2 = 'customers.addressLine2';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'customers.city';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'customers.state';

    /**
     * the column name for the postalCode field
     */
    const COL_POSTALCODE = 'customers.postalCode';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'customers.country';

    /**
     * the column name for the salesRepEmployeeNumber field
     */
    const COL_SALESREPEMPLOYEENUMBER = 'customers.salesRepEmployeeNumber';

    /**
     * the column name for the creditLimit field
     */
    const COL_CREDITLIMIT = 'customers.creditLimit';

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
        self::TYPE_PHPNAME       => array('Customernumber', 'Customername', 'Contactlastname', 'Contactfirstname', 'Phone', 'Addressline1', 'Addressline2', 'City', 'State', 'Postalcode', 'Country', 'Salesrepemployeenumber', 'Creditlimit', ),
        self::TYPE_CAMELNAME     => array('customernumber', 'customername', 'contactlastname', 'contactfirstname', 'phone', 'addressline1', 'addressline2', 'city', 'state', 'postalcode', 'country', 'salesrepemployeenumber', 'creditlimit', ),
        self::TYPE_COLNAME       => array(CustomersTableMap::COL_CUSTOMERNUMBER, CustomersTableMap::COL_CUSTOMERNAME, CustomersTableMap::COL_CONTACTLASTNAME, CustomersTableMap::COL_CONTACTFIRSTNAME, CustomersTableMap::COL_PHONE, CustomersTableMap::COL_ADDRESSLINE1, CustomersTableMap::COL_ADDRESSLINE2, CustomersTableMap::COL_CITY, CustomersTableMap::COL_STATE, CustomersTableMap::COL_POSTALCODE, CustomersTableMap::COL_COUNTRY, CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, CustomersTableMap::COL_CREDITLIMIT, ),
        self::TYPE_FIELDNAME     => array('customerNumber', 'customerName', 'contactLastName', 'contactFirstName', 'phone', 'addressLine1', 'addressLine2', 'city', 'state', 'postalCode', 'country', 'salesRepEmployeeNumber', 'creditLimit', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Customernumber' => 0, 'Customername' => 1, 'Contactlastname' => 2, 'Contactfirstname' => 3, 'Phone' => 4, 'Addressline1' => 5, 'Addressline2' => 6, 'City' => 7, 'State' => 8, 'Postalcode' => 9, 'Country' => 10, 'Salesrepemployeenumber' => 11, 'Creditlimit' => 12, ),
        self::TYPE_CAMELNAME     => array('customernumber' => 0, 'customername' => 1, 'contactlastname' => 2, 'contactfirstname' => 3, 'phone' => 4, 'addressline1' => 5, 'addressline2' => 6, 'city' => 7, 'state' => 8, 'postalcode' => 9, 'country' => 10, 'salesrepemployeenumber' => 11, 'creditlimit' => 12, ),
        self::TYPE_COLNAME       => array(CustomersTableMap::COL_CUSTOMERNUMBER => 0, CustomersTableMap::COL_CUSTOMERNAME => 1, CustomersTableMap::COL_CONTACTLASTNAME => 2, CustomersTableMap::COL_CONTACTFIRSTNAME => 3, CustomersTableMap::COL_PHONE => 4, CustomersTableMap::COL_ADDRESSLINE1 => 5, CustomersTableMap::COL_ADDRESSLINE2 => 6, CustomersTableMap::COL_CITY => 7, CustomersTableMap::COL_STATE => 8, CustomersTableMap::COL_POSTALCODE => 9, CustomersTableMap::COL_COUNTRY => 10, CustomersTableMap::COL_SALESREPEMPLOYEENUMBER => 11, CustomersTableMap::COL_CREDITLIMIT => 12, ),
        self::TYPE_FIELDNAME     => array('customerNumber' => 0, 'customerName' => 1, 'contactLastName' => 2, 'contactFirstName' => 3, 'phone' => 4, 'addressLine1' => 5, 'addressLine2' => 6, 'city' => 7, 'state' => 8, 'postalCode' => 9, 'country' => 10, 'salesRepEmployeeNumber' => 11, 'creditLimit' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Customernumber' => 'CUSTOMERNUMBER',
        'Customers.Customernumber' => 'CUSTOMERNUMBER',
        'customernumber' => 'CUSTOMERNUMBER',
        'customers.customernumber' => 'CUSTOMERNUMBER',
        'CustomersTableMap::COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'COL_CUSTOMERNUMBER' => 'CUSTOMERNUMBER',
        'customerNumber' => 'CUSTOMERNUMBER',
        'customers.customerNumber' => 'CUSTOMERNUMBER',
        'Customername' => 'CUSTOMERNAME',
        'Customers.Customername' => 'CUSTOMERNAME',
        'customername' => 'CUSTOMERNAME',
        'customers.customername' => 'CUSTOMERNAME',
        'CustomersTableMap::COL_CUSTOMERNAME' => 'CUSTOMERNAME',
        'COL_CUSTOMERNAME' => 'CUSTOMERNAME',
        'customerName' => 'CUSTOMERNAME',
        'customers.customerName' => 'CUSTOMERNAME',
        'Contactlastname' => 'CONTACTLASTNAME',
        'Customers.Contactlastname' => 'CONTACTLASTNAME',
        'contactlastname' => 'CONTACTLASTNAME',
        'customers.contactlastname' => 'CONTACTLASTNAME',
        'CustomersTableMap::COL_CONTACTLASTNAME' => 'CONTACTLASTNAME',
        'COL_CONTACTLASTNAME' => 'CONTACTLASTNAME',
        'contactLastName' => 'CONTACTLASTNAME',
        'customers.contactLastName' => 'CONTACTLASTNAME',
        'Contactfirstname' => 'CONTACTFIRSTNAME',
        'Customers.Contactfirstname' => 'CONTACTFIRSTNAME',
        'contactfirstname' => 'CONTACTFIRSTNAME',
        'customers.contactfirstname' => 'CONTACTFIRSTNAME',
        'CustomersTableMap::COL_CONTACTFIRSTNAME' => 'CONTACTFIRSTNAME',
        'COL_CONTACTFIRSTNAME' => 'CONTACTFIRSTNAME',
        'contactFirstName' => 'CONTACTFIRSTNAME',
        'customers.contactFirstName' => 'CONTACTFIRSTNAME',
        'Phone' => 'PHONE',
        'Customers.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'customers.phone' => 'PHONE',
        'CustomersTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'phone' => 'PHONE',
        'customers.phone' => 'PHONE',
        'Addressline1' => 'ADDRESSLINE1',
        'Customers.Addressline1' => 'ADDRESSLINE1',
        'addressline1' => 'ADDRESSLINE1',
        'customers.addressline1' => 'ADDRESSLINE1',
        'CustomersTableMap::COL_ADDRESSLINE1' => 'ADDRESSLINE1',
        'COL_ADDRESSLINE1' => 'ADDRESSLINE1',
        'addressLine1' => 'ADDRESSLINE1',
        'customers.addressLine1' => 'ADDRESSLINE1',
        'Addressline2' => 'ADDRESSLINE2',
        'Customers.Addressline2' => 'ADDRESSLINE2',
        'addressline2' => 'ADDRESSLINE2',
        'customers.addressline2' => 'ADDRESSLINE2',
        'CustomersTableMap::COL_ADDRESSLINE2' => 'ADDRESSLINE2',
        'COL_ADDRESSLINE2' => 'ADDRESSLINE2',
        'addressLine2' => 'ADDRESSLINE2',
        'customers.addressLine2' => 'ADDRESSLINE2',
        'City' => 'CITY',
        'Customers.City' => 'CITY',
        'city' => 'CITY',
        'customers.city' => 'CITY',
        'CustomersTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'city' => 'CITY',
        'customers.city' => 'CITY',
        'State' => 'STATE',
        'Customers.State' => 'STATE',
        'state' => 'STATE',
        'customers.state' => 'STATE',
        'CustomersTableMap::COL_STATE' => 'STATE',
        'COL_STATE' => 'STATE',
        'state' => 'STATE',
        'customers.state' => 'STATE',
        'Postalcode' => 'POSTALCODE',
        'Customers.Postalcode' => 'POSTALCODE',
        'postalcode' => 'POSTALCODE',
        'customers.postalcode' => 'POSTALCODE',
        'CustomersTableMap::COL_POSTALCODE' => 'POSTALCODE',
        'COL_POSTALCODE' => 'POSTALCODE',
        'postalCode' => 'POSTALCODE',
        'customers.postalCode' => 'POSTALCODE',
        'Country' => 'COUNTRY',
        'Customers.Country' => 'COUNTRY',
        'country' => 'COUNTRY',
        'customers.country' => 'COUNTRY',
        'CustomersTableMap::COL_COUNTRY' => 'COUNTRY',
        'COL_COUNTRY' => 'COUNTRY',
        'country' => 'COUNTRY',
        'customers.country' => 'COUNTRY',
        'Salesrepemployeenumber' => 'SALESREPEMPLOYEENUMBER',
        'Customers.Salesrepemployeenumber' => 'SALESREPEMPLOYEENUMBER',
        'salesrepemployeenumber' => 'SALESREPEMPLOYEENUMBER',
        'customers.salesrepemployeenumber' => 'SALESREPEMPLOYEENUMBER',
        'CustomersTableMap::COL_SALESREPEMPLOYEENUMBER' => 'SALESREPEMPLOYEENUMBER',
        'COL_SALESREPEMPLOYEENUMBER' => 'SALESREPEMPLOYEENUMBER',
        'salesRepEmployeeNumber' => 'SALESREPEMPLOYEENUMBER',
        'customers.salesRepEmployeeNumber' => 'SALESREPEMPLOYEENUMBER',
        'Creditlimit' => 'CREDITLIMIT',
        'Customers.Creditlimit' => 'CREDITLIMIT',
        'creditlimit' => 'CREDITLIMIT',
        'customers.creditlimit' => 'CREDITLIMIT',
        'CustomersTableMap::COL_CREDITLIMIT' => 'CREDITLIMIT',
        'COL_CREDITLIMIT' => 'CREDITLIMIT',
        'creditLimit' => 'CREDITLIMIT',
        'customers.creditLimit' => 'CREDITLIMIT',
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
        $this->setName('customers');
        $this->setPhpName('Customers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Customers');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('customerNumber', 'Customernumber', 'INTEGER', true, null, null);
        $this->addColumn('customerName', 'Customername', 'VARCHAR', true, 50, null);
        $this->addColumn('contactLastName', 'Contactlastname', 'VARCHAR', true, 50, null);
        $this->addColumn('contactFirstName', 'Contactfirstname', 'VARCHAR', true, 50, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 50, null);
        $this->addColumn('addressLine1', 'Addressline1', 'VARCHAR', true, 50, null);
        $this->addColumn('addressLine2', 'Addressline2', 'VARCHAR', false, 50, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 50, null);
        $this->addColumn('state', 'State', 'VARCHAR', false, 50, null);
        $this->addColumn('postalCode', 'Postalcode', 'VARCHAR', false, 15, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 50, null);
        $this->addForeignKey('salesRepEmployeeNumber', 'Salesrepemployeenumber', 'INTEGER', 'employees', 'employeeNumber', false, null, null);
        $this->addColumn('creditLimit', 'Creditlimit', 'DECIMAL', false, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Employees', '\\Employees', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':salesRepEmployeeNumber',
    1 => ':employeeNumber',
  ),
), null, null, null, false);
        $this->addRelation('Orders', '\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerNumber',
    1 => ':customerNumber',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('Payments', '\\Payments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customerNumber',
    1 => ':customerNumber',
  ),
), null, null, 'Paymentss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CustomersTableMap::CLASS_DEFAULT : CustomersTableMap::OM_CLASS;
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
     * @return array           (Customers object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CustomersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CustomersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CustomersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CustomersTableMap::OM_CLASS;
            /** @var Customers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CustomersTableMap::addInstanceToPool($obj, $key);
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
            $key = CustomersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CustomersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Customers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CustomersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CustomersTableMap::COL_CUSTOMERNUMBER);
            $criteria->addSelectColumn(CustomersTableMap::COL_CUSTOMERNAME);
            $criteria->addSelectColumn(CustomersTableMap::COL_CONTACTLASTNAME);
            $criteria->addSelectColumn(CustomersTableMap::COL_CONTACTFIRSTNAME);
            $criteria->addSelectColumn(CustomersTableMap::COL_PHONE);
            $criteria->addSelectColumn(CustomersTableMap::COL_ADDRESSLINE1);
            $criteria->addSelectColumn(CustomersTableMap::COL_ADDRESSLINE2);
            $criteria->addSelectColumn(CustomersTableMap::COL_CITY);
            $criteria->addSelectColumn(CustomersTableMap::COL_STATE);
            $criteria->addSelectColumn(CustomersTableMap::COL_POSTALCODE);
            $criteria->addSelectColumn(CustomersTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER);
            $criteria->addSelectColumn(CustomersTableMap::COL_CREDITLIMIT);
        } else {
            $criteria->addSelectColumn($alias . '.customerNumber');
            $criteria->addSelectColumn($alias . '.customerName');
            $criteria->addSelectColumn($alias . '.contactLastName');
            $criteria->addSelectColumn($alias . '.contactFirstName');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.addressLine1');
            $criteria->addSelectColumn($alias . '.addressLine2');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.postalCode');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.salesRepEmployeeNumber');
            $criteria->addSelectColumn($alias . '.creditLimit');
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
            $criteria->removeSelectColumn(CustomersTableMap::COL_CUSTOMERNUMBER);
            $criteria->removeSelectColumn(CustomersTableMap::COL_CUSTOMERNAME);
            $criteria->removeSelectColumn(CustomersTableMap::COL_CONTACTLASTNAME);
            $criteria->removeSelectColumn(CustomersTableMap::COL_CONTACTFIRSTNAME);
            $criteria->removeSelectColumn(CustomersTableMap::COL_PHONE);
            $criteria->removeSelectColumn(CustomersTableMap::COL_ADDRESSLINE1);
            $criteria->removeSelectColumn(CustomersTableMap::COL_ADDRESSLINE2);
            $criteria->removeSelectColumn(CustomersTableMap::COL_CITY);
            $criteria->removeSelectColumn(CustomersTableMap::COL_STATE);
            $criteria->removeSelectColumn(CustomersTableMap::COL_POSTALCODE);
            $criteria->removeSelectColumn(CustomersTableMap::COL_COUNTRY);
            $criteria->removeSelectColumn(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER);
            $criteria->removeSelectColumn(CustomersTableMap::COL_CREDITLIMIT);
        } else {
            $criteria->removeSelectColumn($alias . '.customerNumber');
            $criteria->removeSelectColumn($alias . '.customerName');
            $criteria->removeSelectColumn($alias . '.contactLastName');
            $criteria->removeSelectColumn($alias . '.contactFirstName');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.addressLine1');
            $criteria->removeSelectColumn($alias . '.addressLine2');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.state');
            $criteria->removeSelectColumn($alias . '.postalCode');
            $criteria->removeSelectColumn($alias . '.country');
            $criteria->removeSelectColumn($alias . '.salesRepEmployeeNumber');
            $criteria->removeSelectColumn($alias . '.creditLimit');
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
        return Propel::getServiceContainer()->getDatabaseMap(CustomersTableMap::DATABASE_NAME)->getTable(CustomersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CustomersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CustomersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CustomersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Customers or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Customers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Customers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CustomersTableMap::DATABASE_NAME);
            $criteria->add(CustomersTableMap::COL_CUSTOMERNUMBER, (array) $values, Criteria::IN);
        }

        $query = CustomersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CustomersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CustomersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the customers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CustomersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Customers or Criteria object.
     *
     * @param mixed               $criteria Criteria or Customers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Customers object
        }


        // Set the correct dbName
        $query = CustomersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CustomersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CustomersTableMap::buildTableMap();
