<?php

namespace Base;

use \Customers as ChildCustomers;
use \CustomersQuery as ChildCustomersQuery;
use \Orderdetails as ChildOrderdetails;
use \OrderdetailsQuery as ChildOrderdetailsQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OrderdetailsTableMap;
use Map\OrdersTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'orders' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Orders implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrdersTableMap';


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
     * The value for the ordernumber field.
     *
     * @var        int
     */
    protected $ordernumber;

    /**
     * The value for the orderdate field.
     *
     * @var        DateTime
     */
    protected $orderdate;

    /**
     * The value for the requireddate field.
     *
     * @var        DateTime
     */
    protected $requireddate;

    /**
     * The value for the shippeddate field.
     *
     * @var        DateTime|null
     */
    protected $shippeddate;

    /**
     * The value for the status field.
     *
     * @var        string
     */
    protected $status;

    /**
     * The value for the comments field.
     *
     * @var        string|null
     */
    protected $comments;

    /**
     * The value for the customernumber field.
     *
     * @var        int
     */
    protected $customernumber;

    /**
     * @var        ChildCustomers
     */
    protected $aCustomers;

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
     * Initializes internal state of Base\Orders object.
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
     * Compares this with another <code>Orders</code> instance.  If
     * <code>obj</code> is an instance of <code>Orders</code>, delegates to
     * <code>equals(Orders)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [ordernumber] column value.
     *
     * @return int
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Get the [optionally formatted] temporal [orderdate] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getOrderdate($format = null)
    {
        if ($format === null) {
            return $this->orderdate;
        } else {
            return $this->orderdate instanceof \DateTimeInterface ? $this->orderdate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [requireddate] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getRequireddate($format = null)
    {
        if ($format === null) {
            return $this->requireddate;
        } else {
            return $this->requireddate instanceof \DateTimeInterface ? $this->requireddate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [shippeddate] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getShippeddate($format = null)
    {
        if ($format === null) {
            return $this->shippeddate;
        } else {
            return $this->shippeddate instanceof \DateTimeInterface ? $this->shippeddate->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [comments] column value.
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get the [customernumber] column value.
     *
     * @return int
     */
    public function getCustomernumber()
    {
        return $this->customernumber;
    }

    /**
     * Set the value of [ordernumber] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setOrdernumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ordernumber !== $v) {
            $this->ordernumber = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDERNUMBER] = true;
        }

        return $this;
    } // setOrdernumber()

    /**
     * Sets the value of [orderdate] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setOrderdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->orderdate !== null || $dt !== null) {
            if ($this->orderdate === null || $dt === null || $dt->format("Y-m-d") !== $this->orderdate->format("Y-m-d")) {
                $this->orderdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_ORDERDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setOrderdate()

    /**
     * Sets the value of [requireddate] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setRequireddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->requireddate !== null || $dt !== null) {
            if ($this->requireddate === null || $dt === null || $dt->format("Y-m-d") !== $this->requireddate->format("Y-m-d")) {
                $this->requireddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_REQUIREDDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRequireddate()

    /**
     * Sets the value of [shippeddate] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setShippeddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->shippeddate !== null || $dt !== null) {
            if ($this->shippeddate === null || $dt === null || $dt->format("Y-m-d") !== $this->shippeddate->format("Y-m-d")) {
                $this->shippeddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_SHIPPEDDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setShippeddate()

    /**
     * Set the value of [status] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OrdersTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [comments] column.
     *
     * @param string|null $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comments !== $v) {
            $this->comments = $v;
            $this->modifiedColumns[OrdersTableMap::COL_COMMENTS] = true;
        }

        return $this;
    } // setComments()

    /**
     * Set the value of [customernumber] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setCustomernumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->customernumber !== $v) {
            $this->customernumber = $v;
            $this->modifiedColumns[OrdersTableMap::COL_CUSTOMERNUMBER] = true;
        }

        if ($this->aCustomers !== null && $this->aCustomers->getCustomernumber() !== $v) {
            $this->aCustomers = null;
        }

        return $this;
    } // setCustomernumber()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrdersTableMap::translateFieldName('Ordernumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ordernumber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrdersTableMap::translateFieldName('Orderdate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->orderdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrdersTableMap::translateFieldName('Requireddate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->requireddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrdersTableMap::translateFieldName('Shippeddate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->shippeddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrdersTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrdersTableMap::translateFieldName('Comments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrdersTableMap::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customernumber = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = OrdersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orders'), 0, $e);
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
        if ($this->aCustomers !== null && $this->customernumber !== $this->aCustomers->getCustomernumber()) {
            $this->aCustomers = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrdersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCustomers = null;
            $this->collOrderdetailss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Orders::setDeleted()
     * @see Orders::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrdersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
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
                OrdersTableMap::addInstanceToPool($this);
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

            if ($this->aCustomers !== null) {
                if ($this->aCustomers->isModified() || $this->aCustomers->isNew()) {
                    $affectedRows += $this->aCustomers->save($con);
                }
                $this->setCustomers($this->aCustomers);
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
        if ($this->isColumnModified(OrdersTableMap::COL_ORDERNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'orderNumber';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDERDATE)) {
            $modifiedColumns[':p' . $index++]  = 'orderDate';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REQUIREDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'requiredDate';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_SHIPPEDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'shippedDate';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'comments';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CUSTOMERNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'customerNumber';
        }

        $sql = sprintf(
            'INSERT INTO orders (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'orderNumber':
                        $stmt->bindValue($identifier, $this->ordernumber, PDO::PARAM_INT);
                        break;
                    case 'orderDate':
                        $stmt->bindValue($identifier, $this->orderdate ? $this->orderdate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'requiredDate':
                        $stmt->bindValue($identifier, $this->requireddate ? $this->requireddate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'shippedDate':
                        $stmt->bindValue($identifier, $this->shippeddate ? $this->shippeddate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'comments':
                        $stmt->bindValue($identifier, $this->comments, PDO::PARAM_STR);
                        break;
                    case 'customerNumber':
                        $stmt->bindValue($identifier, $this->customernumber, PDO::PARAM_INT);
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
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrdernumber();
                break;
            case 1:
                return $this->getOrderdate();
                break;
            case 2:
                return $this->getRequireddate();
                break;
            case 3:
                return $this->getShippeddate();
                break;
            case 4:
                return $this->getStatus();
                break;
            case 5:
                return $this->getComments();
                break;
            case 6:
                return $this->getCustomernumber();
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

        if (isset($alreadyDumpedObjects['Orders'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Orders'][$this->hashCode()] = true;
        $keys = OrdersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOrdernumber(),
            $keys[1] => $this->getOrderdate(),
            $keys[2] => $this->getRequireddate(),
            $keys[3] => $this->getShippeddate(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getComments(),
            $keys[6] => $this->getCustomernumber(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCustomers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'customers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'customers';
                        break;
                    default:
                        $key = 'Customers';
                }

                $result[$key] = $this->aCustomers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Orders
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Orders
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOrdernumber($value);
                break;
            case 1:
                $this->setOrderdate($value);
                break;
            case 2:
                $this->setRequireddate($value);
                break;
            case 3:
                $this->setShippeddate($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setComments($value);
                break;
            case 6:
                $this->setCustomernumber($value);
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
     * @return     $this|\Orders
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OrdersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrdernumber($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrderdate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setRequireddate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setShippeddate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setComments($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCustomernumber($arr[$keys[6]]);
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
     * @return $this|\Orders The current object, for fluid interface
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
        $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrdersTableMap::COL_ORDERNUMBER)) {
            $criteria->add(OrdersTableMap::COL_ORDERNUMBER, $this->ordernumber);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDERDATE)) {
            $criteria->add(OrdersTableMap::COL_ORDERDATE, $this->orderdate);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REQUIREDDATE)) {
            $criteria->add(OrdersTableMap::COL_REQUIREDDATE, $this->requireddate);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_SHIPPEDDATE)) {
            $criteria->add(OrdersTableMap::COL_SHIPPEDDATE, $this->shippeddate);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_STATUS)) {
            $criteria->add(OrdersTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_COMMENTS)) {
            $criteria->add(OrdersTableMap::COL_COMMENTS, $this->comments);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CUSTOMERNUMBER)) {
            $criteria->add(OrdersTableMap::COL_CUSTOMERNUMBER, $this->customernumber);
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
        $criteria = ChildOrdersQuery::create();
        $criteria->add(OrdersTableMap::COL_ORDERNUMBER, $this->ordernumber);

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
        $validPk = null !== $this->getOrdernumber();

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
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getOrdernumber();
    }

    /**
     * Generic method to set the primary key (ordernumber column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOrdernumber($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOrdernumber();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Orders (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOrdernumber($this->getOrdernumber());
        $copyObj->setOrderdate($this->getOrderdate());
        $copyObj->setRequireddate($this->getRequireddate());
        $copyObj->setShippeddate($this->getShippeddate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setComments($this->getComments());
        $copyObj->setCustomernumber($this->getCustomernumber());

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
     * @return \Orders Clone of current object.
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
     * Declares an association between this object and a ChildCustomers object.
     *
     * @param  ChildCustomers $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCustomers(ChildCustomers $v = null)
    {
        if ($v === null) {
            $this->setCustomernumber(NULL);
        } else {
            $this->setCustomernumber($v->getCustomernumber());
        }

        $this->aCustomers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCustomers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCustomers object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCustomers The associated ChildCustomers object.
     * @throws PropelException
     */
    public function getCustomers(ConnectionInterface $con = null)
    {
        if ($this->aCustomers === null && ($this->customernumber != 0)) {
            $this->aCustomers = ChildCustomersQuery::create()->findPk($this->customernumber, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCustomers->addOrderss($this);
             */
        }

        return $this->aCustomers;
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
     * If this ChildOrders is new, it will return
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
                    ->filterByOrders($this)
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
     * @return $this|ChildOrders The current object (for fluent API support)
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
            $orderdetailsRemoved->setOrders(null);
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
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collOrderdetailss);
    }

    /**
     * Method called to associate a ChildOrderdetails object to this object
     * through the ChildOrderdetails foreign key attribute.
     *
     * @param  ChildOrderdetails $l ChildOrderdetails
     * @return $this|\Orders The current object (for fluent API support)
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
        $orderdetails->setOrders($this);
    }

    /**
     * @param  ChildOrderdetails $orderdetails The ChildOrderdetails object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
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
            $orderdetails->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Orderdetailss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderdetails[] List of ChildOrderdetails objects
     */
    public function getOrderdetailssJoinProducts(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderdetailsQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOrderdetailss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCustomers) {
            $this->aCustomers->removeOrders($this);
        }
        $this->ordernumber = null;
        $this->orderdate = null;
        $this->requireddate = null;
        $this->shippeddate = null;
        $this->status = null;
        $this->comments = null;
        $this->customernumber = null;
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
        $this->aCustomers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrdersTableMap::DEFAULT_STRING_FORMAT);
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
