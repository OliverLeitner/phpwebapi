<?php

namespace Map;

use \Productlines;
use \ProductlinesQuery;
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
 * This class defines the structure of the 'productlines' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductlinesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProductlinesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'productlines';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Productlines';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Productlines';

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
     * the column name for the productLine field
     */
    const COL_PRODUCTLINE = 'productlines.productLine';

    /**
     * the column name for the textDescription field
     */
    const COL_TEXTDESCRIPTION = 'productlines.textDescription';

    /**
     * the column name for the htmlDescription field
     */
    const COL_HTMLDESCRIPTION = 'productlines.htmlDescription';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'productlines.image';

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
        self::TYPE_PHPNAME       => array('Productline', 'Textdescription', 'Htmldescription', 'Image', ),
        self::TYPE_CAMELNAME     => array('productline', 'textdescription', 'htmldescription', 'image', ),
        self::TYPE_COLNAME       => array(ProductlinesTableMap::COL_PRODUCTLINE, ProductlinesTableMap::COL_TEXTDESCRIPTION, ProductlinesTableMap::COL_HTMLDESCRIPTION, ProductlinesTableMap::COL_IMAGE, ),
        self::TYPE_FIELDNAME     => array('productLine', 'textDescription', 'htmlDescription', 'image', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Productline' => 0, 'Textdescription' => 1, 'Htmldescription' => 2, 'Image' => 3, ),
        self::TYPE_CAMELNAME     => array('productline' => 0, 'textdescription' => 1, 'htmldescription' => 2, 'image' => 3, ),
        self::TYPE_COLNAME       => array(ProductlinesTableMap::COL_PRODUCTLINE => 0, ProductlinesTableMap::COL_TEXTDESCRIPTION => 1, ProductlinesTableMap::COL_HTMLDESCRIPTION => 2, ProductlinesTableMap::COL_IMAGE => 3, ),
        self::TYPE_FIELDNAME     => array('productLine' => 0, 'textDescription' => 1, 'htmlDescription' => 2, 'image' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Productline' => 'PRODUCTLINE',
        'Productlines.Productline' => 'PRODUCTLINE',
        'productline' => 'PRODUCTLINE',
        'productlines.productline' => 'PRODUCTLINE',
        'ProductlinesTableMap::COL_PRODUCTLINE' => 'PRODUCTLINE',
        'COL_PRODUCTLINE' => 'PRODUCTLINE',
        'productLine' => 'PRODUCTLINE',
        'productlines.productLine' => 'PRODUCTLINE',
        'Textdescription' => 'TEXTDESCRIPTION',
        'Productlines.Textdescription' => 'TEXTDESCRIPTION',
        'textdescription' => 'TEXTDESCRIPTION',
        'productlines.textdescription' => 'TEXTDESCRIPTION',
        'ProductlinesTableMap::COL_TEXTDESCRIPTION' => 'TEXTDESCRIPTION',
        'COL_TEXTDESCRIPTION' => 'TEXTDESCRIPTION',
        'textDescription' => 'TEXTDESCRIPTION',
        'productlines.textDescription' => 'TEXTDESCRIPTION',
        'Htmldescription' => 'HTMLDESCRIPTION',
        'Productlines.Htmldescription' => 'HTMLDESCRIPTION',
        'htmldescription' => 'HTMLDESCRIPTION',
        'productlines.htmldescription' => 'HTMLDESCRIPTION',
        'ProductlinesTableMap::COL_HTMLDESCRIPTION' => 'HTMLDESCRIPTION',
        'COL_HTMLDESCRIPTION' => 'HTMLDESCRIPTION',
        'htmlDescription' => 'HTMLDESCRIPTION',
        'productlines.htmlDescription' => 'HTMLDESCRIPTION',
        'Image' => 'IMAGE',
        'Productlines.Image' => 'IMAGE',
        'image' => 'IMAGE',
        'productlines.image' => 'IMAGE',
        'ProductlinesTableMap::COL_IMAGE' => 'IMAGE',
        'COL_IMAGE' => 'IMAGE',
        'image' => 'IMAGE',
        'productlines.image' => 'IMAGE',
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
        $this->setName('productlines');
        $this->setPhpName('Productlines');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Productlines');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('productLine', 'Productline', 'VARCHAR', true, 50, null);
        $this->addColumn('textDescription', 'Textdescription', 'VARCHAR', false, 4000, null);
        $this->addColumn('htmlDescription', 'Htmldescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('image', 'Image', 'VARBINARY', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Products', '\\Products', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':productLine',
    1 => ':productLine',
  ),
), null, null, 'Productss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductlinesTableMap::CLASS_DEFAULT : ProductlinesTableMap::OM_CLASS;
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
     * @return array           (Productlines object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductlinesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductlinesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductlinesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductlinesTableMap::OM_CLASS;
            /** @var Productlines $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductlinesTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductlinesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductlinesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Productlines $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductlinesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductlinesTableMap::COL_PRODUCTLINE);
            $criteria->addSelectColumn(ProductlinesTableMap::COL_TEXTDESCRIPTION);
            $criteria->addSelectColumn(ProductlinesTableMap::COL_HTMLDESCRIPTION);
            $criteria->addSelectColumn(ProductlinesTableMap::COL_IMAGE);
        } else {
            $criteria->addSelectColumn($alias . '.productLine');
            $criteria->addSelectColumn($alias . '.textDescription');
            $criteria->addSelectColumn($alias . '.htmlDescription');
            $criteria->addSelectColumn($alias . '.image');
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
            $criteria->removeSelectColumn(ProductlinesTableMap::COL_PRODUCTLINE);
            $criteria->removeSelectColumn(ProductlinesTableMap::COL_TEXTDESCRIPTION);
            $criteria->removeSelectColumn(ProductlinesTableMap::COL_HTMLDESCRIPTION);
            $criteria->removeSelectColumn(ProductlinesTableMap::COL_IMAGE);
        } else {
            $criteria->removeSelectColumn($alias . '.productLine');
            $criteria->removeSelectColumn($alias . '.textDescription');
            $criteria->removeSelectColumn($alias . '.htmlDescription');
            $criteria->removeSelectColumn($alias . '.image');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductlinesTableMap::DATABASE_NAME)->getTable(ProductlinesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductlinesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductlinesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductlinesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Productlines or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Productlines object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductlinesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Productlines) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductlinesTableMap::DATABASE_NAME);
            $criteria->add(ProductlinesTableMap::COL_PRODUCTLINE, (array) $values, Criteria::IN);
        }

        $query = ProductlinesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductlinesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductlinesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the productlines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductlinesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Productlines or Criteria object.
     *
     * @param mixed               $criteria Criteria or Productlines object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductlinesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Productlines object
        }


        // Set the correct dbName
        $query = ProductlinesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductlinesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductlinesTableMap::buildTableMap();
