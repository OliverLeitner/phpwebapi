<?php

namespace Base;

use \Employees as ChildEmployees;
use \EmployeesQuery as ChildEmployeesQuery;
use \Offices as ChildOffices;
use \OfficesQuery as ChildOfficesQuery;
use \Exception;
use \PDO;
use Map\EmployeesTableMap;
use Map\OfficesTableMap;
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
 * Base class that represents a row from the 'offices' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Offices implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OfficesTableMap';


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
     * The value for the officecode field.
     *
     * @var        string
     */
    protected $officecode;

    /**
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the addressline1 field.
     *
     * @var        string
     */
    protected $addressline1;

    /**
     * The value for the addressline2 field.
     *
     * @var        string|null
     */
    protected $addressline2;

    /**
     * The value for the state field.
     *
     * @var        string|null
     */
    protected $state;

    /**
     * The value for the country field.
     *
     * @var        string
     */
    protected $country;

    /**
     * The value for the postalcode field.
     *
     * @var        string
     */
    protected $postalcode;

    /**
     * The value for the territory field.
     *
     * @var        string
     */
    protected $territory;

    /**
     * @var        ObjectCollection|ChildEmployees[] Collection to store aggregation of ChildEmployees objects.
     */
    protected $collEmployeess;
    protected $collEmployeessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployees[]
     */
    protected $employeessScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Offices object.
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
     * Compares this with another <code>Offices</code> instance.  If
     * <code>obj</code> is an instance of <code>Offices</code>, delegates to
     * <code>equals(Offices)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [officecode] column value.
     *
     * @return string
     */
    public function getOfficecode()
    {
        return $this->officecode;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [addressline1] column value.
     *
     * @return string
     */
    public function getAddressline1()
    {
        return $this->addressline1;
    }

    /**
     * Get the [addressline2] column value.
     *
     * @return string|null
     */
    public function getAddressline2()
    {
        return $this->addressline2;
    }

    /**
     * Get the [state] column value.
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [postalcode] column value.
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Get the [territory] column value.
     *
     * @return string
     */
    public function getTerritory()
    {
        return $this->territory;
    }

    /**
     * Set the value of [officecode] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setOfficecode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->officecode !== $v) {
            $this->officecode = $v;
            $this->modifiedColumns[OfficesTableMap::COL_OFFICECODE] = true;
        }

        return $this;
    } // setOfficecode()

    /**
     * Set the value of [city] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[OfficesTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[OfficesTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [addressline1] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setAddressline1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressline1 !== $v) {
            $this->addressline1 = $v;
            $this->modifiedColumns[OfficesTableMap::COL_ADDRESSLINE1] = true;
        }

        return $this;
    } // setAddressline1()

    /**
     * Set the value of [addressline2] column.
     *
     * @param string|null $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setAddressline2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressline2 !== $v) {
            $this->addressline2 = $v;
            $this->modifiedColumns[OfficesTableMap::COL_ADDRESSLINE2] = true;
        }

        return $this;
    } // setAddressline2()

    /**
     * Set the value of [state] column.
     *
     * @param string|null $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[OfficesTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Set the value of [country] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[OfficesTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [postalcode] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setPostalcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postalcode !== $v) {
            $this->postalcode = $v;
            $this->modifiedColumns[OfficesTableMap::COL_POSTALCODE] = true;
        }

        return $this;
    } // setPostalcode()

    /**
     * Set the value of [territory] column.
     *
     * @param string $v New value
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function setTerritory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory !== $v) {
            $this->territory = $v;
            $this->modifiedColumns[OfficesTableMap::COL_TERRITORY] = true;
        }

        return $this;
    } // setTerritory()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OfficesTableMap::translateFieldName('Officecode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->officecode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OfficesTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OfficesTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OfficesTableMap::translateFieldName('Addressline1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressline1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OfficesTableMap::translateFieldName('Addressline2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressline2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OfficesTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OfficesTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OfficesTableMap::translateFieldName('Postalcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postalcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OfficesTableMap::translateFieldName('Territory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = OfficesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Offices'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(OfficesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOfficesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEmployeess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Offices::setDeleted()
     * @see Offices::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOfficesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OfficesTableMap::DATABASE_NAME);
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
                OfficesTableMap::addInstanceToPool($this);
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

            if ($this->employeessScheduledForDeletion !== null) {
                if (!$this->employeessScheduledForDeletion->isEmpty()) {
                    \EmployeesQuery::create()
                        ->filterByPrimaryKeys($this->employeessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeessScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeess !== null) {
                foreach ($this->collEmployeess as $referrerFK) {
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
        if ($this->isColumnModified(OfficesTableMap::COL_OFFICECODE)) {
            $modifiedColumns[':p' . $index++]  = 'officeCode';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_ADDRESSLINE1)) {
            $modifiedColumns[':p' . $index++]  = 'addressLine1';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_ADDRESSLINE2)) {
            $modifiedColumns[':p' . $index++]  = 'addressLine2';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'country';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_POSTALCODE)) {
            $modifiedColumns[':p' . $index++]  = 'postalCode';
        }
        if ($this->isColumnModified(OfficesTableMap::COL_TERRITORY)) {
            $modifiedColumns[':p' . $index++]  = 'territory';
        }

        $sql = sprintf(
            'INSERT INTO offices (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'officeCode':
                        $stmt->bindValue($identifier, $this->officecode, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'addressLine1':
                        $stmt->bindValue($identifier, $this->addressline1, PDO::PARAM_STR);
                        break;
                    case 'addressLine2':
                        $stmt->bindValue($identifier, $this->addressline2, PDO::PARAM_STR);
                        break;
                    case 'state':
                        $stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
                        break;
                    case 'country':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case 'postalCode':
                        $stmt->bindValue($identifier, $this->postalcode, PDO::PARAM_STR);
                        break;
                    case 'territory':
                        $stmt->bindValue($identifier, $this->territory, PDO::PARAM_STR);
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
        $pos = OfficesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOfficecode();
                break;
            case 1:
                return $this->getCity();
                break;
            case 2:
                return $this->getPhone();
                break;
            case 3:
                return $this->getAddressline1();
                break;
            case 4:
                return $this->getAddressline2();
                break;
            case 5:
                return $this->getState();
                break;
            case 6:
                return $this->getCountry();
                break;
            case 7:
                return $this->getPostalcode();
                break;
            case 8:
                return $this->getTerritory();
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

        if (isset($alreadyDumpedObjects['Offices'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Offices'][$this->hashCode()] = true;
        $keys = OfficesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOfficecode(),
            $keys[1] => $this->getCity(),
            $keys[2] => $this->getPhone(),
            $keys[3] => $this->getAddressline1(),
            $keys[4] => $this->getAddressline2(),
            $keys[5] => $this->getState(),
            $keys[6] => $this->getCountry(),
            $keys[7] => $this->getPostalcode(),
            $keys[8] => $this->getTerritory(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collEmployeess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employeess';
                        break;
                    default:
                        $key = 'Employeess';
                }

                $result[$key] = $this->collEmployeess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Offices
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OfficesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Offices
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOfficecode($value);
                break;
            case 1:
                $this->setCity($value);
                break;
            case 2:
                $this->setPhone($value);
                break;
            case 3:
                $this->setAddressline1($value);
                break;
            case 4:
                $this->setAddressline2($value);
                break;
            case 5:
                $this->setState($value);
                break;
            case 6:
                $this->setCountry($value);
                break;
            case 7:
                $this->setPostalcode($value);
                break;
            case 8:
                $this->setTerritory($value);
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
     * @return     $this|\Offices
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OfficesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOfficecode($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCity($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPhone($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAddressline1($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAddressline2($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setState($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCountry($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPostalcode($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTerritory($arr[$keys[8]]);
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
     * @return $this|\Offices The current object, for fluid interface
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
        $criteria = new Criteria(OfficesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OfficesTableMap::COL_OFFICECODE)) {
            $criteria->add(OfficesTableMap::COL_OFFICECODE, $this->officecode);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_CITY)) {
            $criteria->add(OfficesTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_PHONE)) {
            $criteria->add(OfficesTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_ADDRESSLINE1)) {
            $criteria->add(OfficesTableMap::COL_ADDRESSLINE1, $this->addressline1);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_ADDRESSLINE2)) {
            $criteria->add(OfficesTableMap::COL_ADDRESSLINE2, $this->addressline2);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_STATE)) {
            $criteria->add(OfficesTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_COUNTRY)) {
            $criteria->add(OfficesTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_POSTALCODE)) {
            $criteria->add(OfficesTableMap::COL_POSTALCODE, $this->postalcode);
        }
        if ($this->isColumnModified(OfficesTableMap::COL_TERRITORY)) {
            $criteria->add(OfficesTableMap::COL_TERRITORY, $this->territory);
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
        $criteria = ChildOfficesQuery::create();
        $criteria->add(OfficesTableMap::COL_OFFICECODE, $this->officecode);

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
        $validPk = null !== $this->getOfficecode();

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
        return $this->getOfficecode();
    }

    /**
     * Generic method to set the primary key (officecode column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOfficecode($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOfficecode();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Offices (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setOfficecode($this->getOfficecode());
        $copyObj->setCity($this->getCity());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setAddressline1($this->getAddressline1());
        $copyObj->setAddressline2($this->getAddressline2());
        $copyObj->setState($this->getState());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setPostalcode($this->getPostalcode());
        $copyObj->setTerritory($this->getTerritory());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEmployeess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployees($relObj->copy($deepCopy));
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
     * @return \Offices Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Employees' === $relationName) {
            $this->initEmployeess();
            return;
        }
    }

    /**
     * Clears out the collEmployeess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEmployeess()
     */
    public function clearEmployeess()
    {
        $this->collEmployeess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEmployeess collection loaded partially.
     */
    public function resetPartialEmployeess($v = true)
    {
        $this->collEmployeessPartial = $v;
    }

    /**
     * Initializes the collEmployeess collection.
     *
     * By default this just sets the collEmployeess collection to an empty array (like clearcollEmployeess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeess($overrideExisting = true)
    {
        if (null !== $this->collEmployeess && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeesTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeess = new $collectionClassName;
        $this->collEmployeess->setModel('\Employees');
    }

    /**
     * Gets an array of ChildEmployees objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOffices is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployees[] List of ChildEmployees objects
     * @throws PropelException
     */
    public function getEmployeess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeessPartial && !$this->isNew();
        if (null === $this->collEmployeess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeess) {
                    $this->initEmployeess();
                } else {
                    $collectionClassName = EmployeesTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeess = new $collectionClassName;
                    $collEmployeess->setModel('\Employees');

                    return $collEmployeess;
                }
            } else {
                $collEmployeess = ChildEmployeesQuery::create(null, $criteria)
                    ->filterByOffices($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeessPartial && count($collEmployeess)) {
                        $this->initEmployeess(false);

                        foreach ($collEmployeess as $obj) {
                            if (false == $this->collEmployeess->contains($obj)) {
                                $this->collEmployeess->append($obj);
                            }
                        }

                        $this->collEmployeessPartial = true;
                    }

                    return $collEmployeess;
                }

                if ($partial && $this->collEmployeess) {
                    foreach ($this->collEmployeess as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeess[] = $obj;
                        }
                    }
                }

                $this->collEmployeess = $collEmployeess;
                $this->collEmployeessPartial = false;
            }
        }

        return $this->collEmployeess;
    }

    /**
     * Sets a collection of ChildEmployees objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $employeess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOffices The current object (for fluent API support)
     */
    public function setEmployeess(Collection $employeess, ConnectionInterface $con = null)
    {
        /** @var ChildEmployees[] $employeessToDelete */
        $employeessToDelete = $this->getEmployeess(new Criteria(), $con)->diff($employeess);


        $this->employeessScheduledForDeletion = $employeessToDelete;

        foreach ($employeessToDelete as $employeesRemoved) {
            $employeesRemoved->setOffices(null);
        }

        $this->collEmployeess = null;
        foreach ($employeess as $employees) {
            $this->addEmployees($employees);
        }

        $this->collEmployeess = $employeess;
        $this->collEmployeessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employees objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Employees objects.
     * @throws PropelException
     */
    public function countEmployeess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeessPartial && !$this->isNew();
        if (null === $this->collEmployeess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeess());
            }

            $query = ChildEmployeesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOffices($this)
                ->count($con);
        }

        return count($this->collEmployeess);
    }

    /**
     * Method called to associate a ChildEmployees object to this object
     * through the ChildEmployees foreign key attribute.
     *
     * @param  ChildEmployees $l ChildEmployees
     * @return $this|\Offices The current object (for fluent API support)
     */
    public function addEmployees(ChildEmployees $l)
    {
        if ($this->collEmployeess === null) {
            $this->initEmployeess();
            $this->collEmployeessPartial = true;
        }

        if (!$this->collEmployeess->contains($l)) {
            $this->doAddEmployees($l);

            if ($this->employeessScheduledForDeletion and $this->employeessScheduledForDeletion->contains($l)) {
                $this->employeessScheduledForDeletion->remove($this->employeessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployees $employees The ChildEmployees object to add.
     */
    protected function doAddEmployees(ChildEmployees $employees)
    {
        $this->collEmployeess[]= $employees;
        $employees->setOffices($this);
    }

    /**
     * @param  ChildEmployees $employees The ChildEmployees object to remove.
     * @return $this|ChildOffices The current object (for fluent API support)
     */
    public function removeEmployees(ChildEmployees $employees)
    {
        if ($this->getEmployeess()->contains($employees)) {
            $pos = $this->collEmployeess->search($employees);
            $this->collEmployeess->remove($pos);
            if (null === $this->employeessScheduledForDeletion) {
                $this->employeessScheduledForDeletion = clone $this->collEmployeess;
                $this->employeessScheduledForDeletion->clear();
            }
            $this->employeessScheduledForDeletion[]= clone $employees;
            $employees->setOffices(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Offices is new, it will return
     * an empty collection; or if this Offices has previously
     * been saved, it will retrieve related Employeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Offices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployees[] List of ChildEmployees objects
     */
    public function getEmployeessJoinEmployeesRelatedByReportsto(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeesQuery::create(null, $criteria);
        $query->joinWith('EmployeesRelatedByReportsto', $joinBehavior);

        return $this->getEmployeess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->officecode = null;
        $this->city = null;
        $this->phone = null;
        $this->addressline1 = null;
        $this->addressline2 = null;
        $this->state = null;
        $this->country = null;
        $this->postalcode = null;
        $this->territory = null;
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
            if ($this->collEmployeess) {
                foreach ($this->collEmployeess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEmployeess = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OfficesTableMap::DEFAULT_STRING_FORMAT);
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
