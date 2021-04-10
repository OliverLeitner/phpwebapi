<?php

namespace Base;

use \Orderdetails as ChildOrderdetails;
use \OrderdetailsQuery as ChildOrderdetailsQuery;
use \Productlines as ChildProductlines;
use \ProductlinesQuery as ChildProductlinesQuery;
use \Products as ChildProducts;
use \ProductsQuery as ChildProductsQuery;
use \Exception;
use \PDO;
use Map\OrderdetailsTableMap;
use Map\ProductsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'products' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Products implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProductsTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the productcode field.
     *
     * @var        string
     */
    protected $productcode;

    /**
     * The value for the productname field.
     *
     * @var        string
     */
    protected $productname;

    /**
     * The value for the productline field.
     *
     * @var        string
     */
    protected $productline;

    /**
     * The value for the productscale field.
     *
     * @var        string
     */
    protected $productscale;

    /**
     * The value for the productvendor field.
     *
     * @var        string
     */
    protected $productvendor;

    /**
     * The value for the productdescription field.
     *
     * @var        string
     */
    protected $productdescription;

    /**
     * The value for the quantityinstock field.
     *
     * @var        int
     */
    protected $quantityinstock;

    /**
     * The value for the buyprice field.
     *
     * @var        string
     */
    protected $buyprice;

    /**
     * The value for the msrp field.
     *
     * @var        string
     */
    protected $msrp;

    /**
     * @var        ChildProductlines
     */
    protected $aProductlines;

    /**
     * @var        ObjectCollection|ChildOrderdetails[] Collection to store aggregation of ChildOrderdetails objects.
     */
    protected $collOrderdetailss;
    protected $collOrderdetailssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderdetails[]
     */
    protected $orderdetailssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Products object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Products</code> instance.  If
     * <code>obj</code> is an instance of <code>Products</code>, delegates to
     * <code>equals(Products)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [productcode] column value.
     *
     * @return string
     */
    public function getProductcode()
    {
        return $this->productcode;
    }

    /**
     * Get the [productname] column value.
     *
     * @return string
     */
    public function getProductname()
    {
        return $this->productname;
    }

    /**
     * Get the [productline] column value.
     *
     * @return string
     */
    public function getProductline()
    {
        return $this->productline;
    }

    /**
     * Get the [productscale] column value.
     *
     * @return string
     */
    public function getProductscale()
    {
        return $this->productscale;
    }

    /**
     * Get the [productvendor] column value.
     *
     * @return string
     */
    public function getProductvendor()
    {
        return $this->productvendor;
    }

    /**
     * Get the [productdescription] column value.
     *
     * @return string
     */
    public function getProductdescription()
    {
        return $this->productdescription;
    }

    /**
     * Get the [quantityinstock] column value.
     *
     * @return int
     */
    public function getQuantityinstock()
    {
        return $this->quantityinstock;
    }

    /**
     * Get the [buyprice] column value.
     *
     * @return string
     */
    public function getBuyprice()
    {
        return $this->buyprice;
    }

    /**
     * Get the [msrp] column value.
     *
     * @return string
     */
    public function getMsrp()
    {
        return $this->msrp;
    }

    /**
     * Set the value of [productcode] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productcode !== $v) {
            $this->productcode = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTCODE] = true;
        }

        return $this;
    } // setProductcode()

    /**
     * Set the value of [productname] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productname !== $v) {
            $this->productname = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTNAME] = true;
        }

        return $this;
    } // setProductname()

    /**
     * Set the value of [productline] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductline($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productline !== $v) {
            $this->productline = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTLINE] = true;
        }

        if ($this->aProductlines !== null && $this->aProductlines->getProductline() !== $v) {
            $this->aProductlines = null;
        }

        return $this;
    } // setProductline()

    /**
     * Set the value of [productscale] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductscale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productscale !== $v) {
            $this->productscale = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTSCALE] = true;
        }

        return $this;
    } // setProductscale()

    /**
     * Set the value of [productvendor] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductvendor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productvendor !== $v) {
            $this->productvendor = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTVENDOR] = true;
        }

        return $this;
    } // setProductvendor()

    /**
     * Set the value of [productdescription] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setProductdescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productdescription !== $v) {
            $this->productdescription = $v;
            $this->modifiedColumns[ProductsTableMap::COL_PRODUCTDESCRIPTION] = true;
        }

        return $this;
    } // setProductdescription()

    /**
     * Set the value of [quantityinstock] column.
     *
     * @param int $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setQuantityinstock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->quantityinstock !== $v) {
            $this->quantityinstock = $v;
            $this->modifiedColumns[ProductsTableMap::COL_QUANTITYINSTOCK] = true;
        }

        return $this;
    } // setQuantityinstock()

    /**
     * Set the value of [buyprice] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setBuyprice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->buyprice !== $v) {
            $this->buyprice = $v;
            $this->modifiedColumns[ProductsTableMap::COL_BUYPRICE] = true;
        }

        return $this;
    } // setBuyprice()

    /**
     * Set the value of [msrp] column.
     *
     * @param string $v New value
     * @return $this|\Products The current object (for fluent API support)
     */
    public function setMsrp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->msrp !== $v) {
            $this->msrp = $v;
            $this->modifiedColumns[ProductsTableMap::COL_MSRP] = true;
        }

        return $this;
    } // setMsrp()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductsTableMap::translateFieldName('Productcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductsTableMap::translateFieldName('Productname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductsTableMap::translateFieldName('Productline', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productline = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductsTableMap::translateFieldName('Productscale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productscale = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductsTableMap::translateFieldName('Productvendor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productvendor = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductsTableMap::translateFieldName('Productdescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productdescription = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductsTableMap::translateFieldName('Quantityinstock', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantityinstock = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductsTableMap::translateFieldName('Buyprice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->buyprice = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductsTableMap::translateFieldName('Msrp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->msrp = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = ProductsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Products'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aProductlines !== null && $this->productline !== $this->aProductlines->getProductline()) {
            $this->aProductlines = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProductlines = null;
            $this->collOrderdetailss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Products::setDeleted()
     * @see Products::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductsQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProductsTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aProductlines !== null) {
                if ($this->aProductlines->isModified() || $this->aProductlines->isNew()) {
                    $affectedRows += $this->aProductlines->save($con);
                }
                $this->setProductlines($this->aProductlines);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->orderdetailssScheduledForDeletion !== null) {
                if (!$this->orderdetailssScheduledForDeletion->isEmpty()) {
                    \OrderdetailsQuery::create()
                        ->filterByPrimaryKeys($this->orderdetailssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderdetailssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderdetailss !== null) {
                foreach ($this->collOrderdetailss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTCODE)) {
            $modifiedColumns[':p' . $index++]  = 'productCode';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'productName';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTLINE)) {
            $modifiedColumns[':p' . $index++]  = 'productLine';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTSCALE)) {
            $modifiedColumns[':p' . $index++]  = 'productScale';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTVENDOR)) {
            $modifiedColumns[':p' . $index++]  = 'productVendor';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTDESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'productDescription';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_QUANTITYINSTOCK)) {
            $modifiedColumns[':p' . $index++]  = 'quantityInStock';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BUYPRICE)) {
            $modifiedColumns[':p' . $index++]  = 'buyPrice';
        }
        if ($this->isColumnModified(ProductsTableMap::COL_MSRP)) {
            $modifiedColumns[':p' . $index++]  = 'MSRP';
        }

        $sql = sprintf(
            'INSERT INTO products (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'productCode':
                        $stmt->bindValue($identifier, $this->productcode, PDO::PARAM_STR);
                        break;
                    case 'productName':
                        $stmt->bindValue($identifier, $this->productname, PDO::PARAM_STR);
                        break;
                    case 'productLine':
                        $stmt->bindValue($identifier, $this->productline, PDO::PARAM_STR);
                        break;
                    case 'productScale':
                        $stmt->bindValue($identifier, $this->productscale, PDO::PARAM_STR);
                        break;
                    case 'productVendor':
                        $stmt->bindValue($identifier, $this->productvendor, PDO::PARAM_STR);
                        break;
                    case 'productDescription':
                        $stmt->bindValue($identifier, $this->productdescription, PDO::PARAM_STR);
                        break;
                    case 'quantityInStock':
                        $stmt->bindValue($identifier, $this->quantityinstock, PDO::PARAM_INT);
                        break;
                    case 'buyPrice':
                        $stmt->bindValue($identifier, $this->buyprice, PDO::PARAM_STR);
                        break;
                    case 'MSRP':
                        $stmt->bindValue($identifier, $this->msrp, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getProductcode();
                break;
            case 1:
                return $this->getProductname();
                break;
            case 2:
                return $this->getProductline();
                break;
            case 3:
                return $this->getProductscale();
                break;
            case 4:
                return $this->getProductvendor();
                break;
            case 5:
                return $this->getProductdescription();
                break;
            case 6:
                return $this->getQuantityinstock();
                break;
            case 7:
                return $this->getBuyprice();
                break;
            case 8:
                return $this->getMsrp();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Products'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Products'][$this->hashCode()] = true;
        $keys = ProductsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getProductcode(),
            $keys[1] => $this->getProductname(),
            $keys[2] => $this->getProductline(),
            $keys[3] => $this->getProductscale(),
            $keys[4] => $this->getProductvendor(),
            $keys[5] => $this->getProductdescription(),
            $keys[6] => $this->getQuantityinstock(),
            $keys[7] => $this->getBuyprice(),
            $keys[8] => $this->getMsrp(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProductlines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productlines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'productlines';
                        break;
                    default:
                        $key = 'Productlines';
                }

                $result[$key] = $this->aProductlines->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrderdetailss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderdetailss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderdetailss';
                        break;
                    default:
                        $key = 'Orderdetailss';
                }

                $result[$key] = $this->collOrderdetailss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Products
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Products
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setProductcode($value);
                break;
            case 1:
                $this->setProductname($value);
                break;
            case 2:
                $this->setProductline($value);
                break;
            case 3:
                $this->setProductscale($value);
                break;
            case 4:
                $this->setProductvendor($value);
                break;
            case 5:
                $this->setProductdescription($value);
                break;
            case 6:
                $this->setQuantityinstock($value);
                break;
            case 7:
                $this->setBuyprice($value);
                break;
            case 8:
                $this->setMsrp($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\Products
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProductsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setProductcode($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setProductname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProductline($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setProductscale($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setProductvendor($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setProductdescription($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQuantityinstock($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBuyprice($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMsrp($arr[$keys[8]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Products The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProductsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTCODE)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTCODE, $this->productcode);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTNAME)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTNAME, $this->productname);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTLINE)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTLINE, $this->productline);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTSCALE)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTSCALE, $this->productscale);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTVENDOR)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTVENDOR, $this->productvendor);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_PRODUCTDESCRIPTION)) {
            $criteria->add(ProductsTableMap::COL_PRODUCTDESCRIPTION, $this->productdescription);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_QUANTITYINSTOCK)) {
            $criteria->add(ProductsTableMap::COL_QUANTITYINSTOCK, $this->quantityinstock);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_BUYPRICE)) {
            $criteria->add(ProductsTableMap::COL_BUYPRICE, $this->buyprice);
        }
        if ($this->isColumnModified(ProductsTableMap::COL_MSRP)) {
            $criteria->add(ProductsTableMap::COL_MSRP, $this->msrp);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildProductsQuery::create();
        $criteria->add(ProductsTableMap::COL_PRODUCTCODE, $this->productcode);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getProductcode();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getProductcode();
    }

    /**
     * Generic method to set the primary key (productcode column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setProductcode($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getProductcode();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Products (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProductcode($this->getProductcode());
        $copyObj->setProductname($this->getProductname());
        $copyObj->setProductline($this->getProductline());
        $copyObj->setProductscale($this->getProductscale());
        $copyObj->setProductvendor($this->getProductvendor());
        $copyObj->setProductdescription($this->getProductdescription());
        $copyObj->setQuantityinstock($this->getQuantityinstock());
        $copyObj->setBuyprice($this->getBuyprice());
        $copyObj->setMsrp($this->getMsrp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderdetailss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderdetails($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Products Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildProductlines object.
     *
     * @param  ChildProductlines $v
     * @return $this|\Products The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProductlines(ChildProductlines $v = null)
    {
        if ($v === null) {
            $this->setProductline(NULL);
        } else {
            $this->setProductline($v->getProductline());
        }

        $this->aProductlines = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProductlines object, it will not be re-added.
        if ($v !== null) {
            $v->addProducts($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProductlines object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProductlines The associated ChildProductlines object.
     * @throws PropelException
     */
    public function getProductlines(ConnectionInterface $con = null)
    {
        if ($this->aProductlines === null && (($this->productline !== "" && $this->productline !== null))) {
            $this->aProductlines = ChildProductlinesQuery::create()->findPk($this->productline, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProductlines->addProductss($this);
             */
        }

        return $this->aProductlines;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Orderdetails' === $relationName) {
            $this->initOrderdetailss();
            return;
        }
    }

    /**
     * Clears out the collOrderdetailss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderdetailss()
     */
    public function clearOrderdetailss()
    {
        $this->collOrderdetailss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderdetailss collection loaded partially.
     */
    public function resetPartialOrderdetailss($v = true)
    {
        $this->collOrderdetailssPartial = $v;
    }

    /**
     * Initializes the collOrderdetailss collection.
     *
     * By default this just sets the collOrderdetailss collection to an empty array (like clearcollOrderdetailss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderdetailss($overrideExisting = true)
    {
        if (null !== $this->collOrderdetailss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderdetailsTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderdetailss = new $collectionClassName;
        $this->collOrderdetailss->setModel('\Orderdetails');
    }

    /**
     * Gets an array of ChildOrderdetails objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducts is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderdetails[] List of ChildOrderdetails objects
     * @throws PropelException
     */
    public function getOrderdetailss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderdetailssPartial && !$this->isNew();
        if (null === $this->collOrderdetailss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderdetailss) {
                    $this->initOrderdetailss();
                } else {
                    $collectionClassName = OrderdetailsTableMap::getTableMap()->getCollectionClassName();

                    $collOrderdetailss = new $collectionClassName;
                    $collOrderdetailss->setModel('\Orderdetails');

                    return $collOrderdetailss;
                }
            } else {
                $collOrderdetailss = ChildOrderdetailsQuery::create(null, $criteria)
                    ->filterByProducts($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderdetailssPartial && count($collOrderdetailss)) {
                        $this->initOrderdetailss(false);

                        foreach ($collOrderdetailss as $obj) {
                            if (false == $this->collOrderdetailss->contains($obj)) {
                                $this->collOrderdetailss->append($obj);
                            }
                        }

                        $this->collOrderdetailssPartial = true;
                    }

                    return $collOrderdetailss;
                }

                if ($partial && $this->collOrderdetailss) {
                    foreach ($this->collOrderdetailss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderdetailss[] = $obj;
                        }
                    }
                }

                $this->collOrderdetailss = $collOrderdetailss;
                $this->collOrderdetailssPartial = false;
            }
        }

        return $this->collOrderdetailss;
    }

    /**
     * Sets a collection of ChildOrderdetails objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderdetailss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProducts The current object (for fluent API support)
     */
    public function setOrderdetailss(Collection $orderdetailss, ConnectionInterface $con = null)
    {
        /** @var ChildOrderdetails[] $orderdetailssToDelete */
        $orderdetailssToDelete = $this->getOrderdetailss(new Criteria(), $con)->diff($orderdetailss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->orderdetailssScheduledForDeletion = clone $orderdetailssToDelete;

        foreach ($orderdetailssToDelete as $orderdetailsRemoved) {
            $orderdetailsRemoved->setProducts(null);
        }

        $this->collOrderdetailss = null;
        foreach ($orderdetailss as $orderdetails) {
            $this->addOrderdetails($orderdetails);
        }

        $this->collOrderdetailss = $orderdetailss;
        $this->collOrderdetailssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orderdetails objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orderdetails objects.
     * @throws PropelException
     */
    public function countOrderdetailss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderdetailssPartial && !$this->isNew();
        if (null === $this->collOrderdetailss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderdetailss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderdetailss());
            }

            $query = ChildOrderdetailsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducts($this)
                ->count($con);
        }

        return count($this->collOrderdetailss);
    }

    /**
     * Method called to associate a ChildOrderdetails object to this object
     * through the ChildOrderdetails foreign key attribute.
     *
     * @param  ChildOrderdetails $l ChildOrderdetails
     * @return $this|\Products The current object (for fluent API support)
     */
    public function addOrderdetails(ChildOrderdetails $l)
    {
        if ($this->collOrderdetailss === null) {
            $this->initOrderdetailss();
            $this->collOrderdetailssPartial = true;
        }

        if (!$this->collOrderdetailss->contains($l)) {
            $this->doAddOrderdetails($l);

            if ($this->orderdetailssScheduledForDeletion and $this->orderdetailssScheduledForDeletion->contains($l)) {
                $this->orderdetailssScheduledForDeletion->remove($this->orderdetailssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderdetails $orderdetails The ChildOrderdetails object to add.
     */
    protected function doAddOrderdetails(ChildOrderdetails $orderdetails)
    {
        $this->collOrderdetailss[]= $orderdetails;
        $orderdetails->setProducts($this);
    }

    /**
     * @param  ChildOrderdetails $orderdetails The ChildOrderdetails object to remove.
     * @return $this|ChildProducts The current object (for fluent API support)
     */
    public function removeOrderdetails(ChildOrderdetails $orderdetails)
    {
        if ($this->getOrderdetailss()->contains($orderdetails)) {
            $pos = $this->collOrderdetailss->search($orderdetails);
            $this->collOrderdetailss->remove($pos);
            if (null === $this->orderdetailssScheduledForDeletion) {
                $this->orderdetailssScheduledForDeletion = clone $this->collOrderdetailss;
                $this->orderdetailssScheduledForDeletion->clear();
            }
            $this->orderdetailssScheduledForDeletion[]= clone $orderdetails;
            $orderdetails->setProducts(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Products is new, it will return
     * an empty collection; or if this Products has previously
     * been saved, it will retrieve related Orderdetailss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Products.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderdetails[] List of ChildOrderdetails objects
     */
    public function getOrderdetailssJoinOrders(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderdetailsQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderdetailss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aProductlines) {
            $this->aProductlines->removeProducts($this);
        }
        $this->productcode = null;
        $this->productname = null;
        $this->productline = null;
        $this->productscale = null;
        $this->productvendor = null;
        $this->productdescription = null;
        $this->quantityinstock = null;
        $this->buyprice = null;
        $this->msrp = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collOrderdetailss) {
                foreach ($this->collOrderdetailss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderdetailss = null;
        $this->aProductlines = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductsTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
