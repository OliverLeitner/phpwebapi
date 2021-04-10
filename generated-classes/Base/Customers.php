<?php

namespace Base;

use \Customers as ChildCustomers;
use \CustomersQuery as ChildCustomersQuery;
use \Employees as ChildEmployees;
use \EmployeesQuery as ChildEmployeesQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Payments as ChildPayments;
use \PaymentsQuery as ChildPaymentsQuery;
use \Exception;
use \PDO;
use Map\CustomersTableMap;
use Map\OrdersTableMap;
use Map\PaymentsTableMap;
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
 * Base class that represents a row from the 'customers' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Customers implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CustomersTableMap';


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
     * The value for the customernumber field.
     *
     * @var        int
     */
    protected $customernumber;

    /**
     * The value for the customername field.
     *
     * @var        string
     */
    protected $customername;

    /**
     * The value for the contactlastname field.
     *
     * @var        string
     */
    protected $contactlastname;

    /**
     * The value for the contactfirstname field.
     *
     * @var        string
     */
    protected $contactfirstname;

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
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * The value for the state field.
     *
     * @var        string|null
     */
    protected $state;

    /**
     * The value for the postalcode field.
     *
     * @var        string|null
     */
    protected $postalcode;

    /**
     * The value for the country field.
     *
     * @var        string
     */
    protected $country;

    /**
     * The value for the salesrepemployeenumber field.
     *
     * @var        int|null
     */
    protected $salesrepemployeenumber;

    /**
     * The value for the creditlimit field.
     *
     * @var        string|null
     */
    protected $creditlimit;

    /**
     * @var        ChildEmployees
     */
    protected $aEmployees;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildPayments[] Collection to store aggregation of ChildPayments objects.
     */
    protected $collPaymentss;
    protected $collPaymentssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPayments[]
     */
    protected $paymentssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Customers object.
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
     * Compares this with another <code>Customers</code> instance.  If
     * <code>obj</code> is an instance of <code>Customers</code>, delegates to
     * <code>equals(Customers)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [customernumber] column value.
     *
     * @return int
     */
    public function getCustomernumber()
    {
        return $this->customernumber;
    }

    /**
     * Get the [customername] column value.
     *
     * @return string
     */
    public function getCustomername()
    {
        return $this->customername;
    }

    /**
     * Get the [contactlastname] column value.
     *
     * @return string
     */
    public function getContactlastname()
    {
        return $this->contactlastname;
    }

    /**
     * Get the [contactfirstname] column value.
     *
     * @return string
     */
    public function getContactfirstname()
    {
        return $this->contactfirstname;
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
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
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
     * Get the [postalcode] column value.
     *
     * @return string|null
     */
    public function getPostalcode()
    {
        return $this->postalcode;
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
     * Get the [salesrepemployeenumber] column value.
     *
     * @return int|null
     */
    public function getSalesrepemployeenumber()
    {
        return $this->salesrepemployeenumber;
    }

    /**
     * Get the [creditlimit] column value.
     *
     * @return string|null
     */
    public function getCreditlimit()
    {
        return $this->creditlimit;
    }

    /**
     * Set the value of [customernumber] column.
     *
     * @param int $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setCustomernumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->customernumber !== $v) {
            $this->customernumber = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CUSTOMERNUMBER] = true;
        }

        return $this;
    } // setCustomernumber()

    /**
     * Set the value of [customername] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setCustomername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customername !== $v) {
            $this->customername = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CUSTOMERNAME] = true;
        }

        return $this;
    } // setCustomername()

    /**
     * Set the value of [contactlastname] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setContactlastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contactlastname !== $v) {
            $this->contactlastname = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CONTACTLASTNAME] = true;
        }

        return $this;
    } // setContactlastname()

    /**
     * Set the value of [contactfirstname] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setContactfirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contactfirstname !== $v) {
            $this->contactfirstname = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CONTACTFIRSTNAME] = true;
        }

        return $this;
    } // setContactfirstname()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[CustomersTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [addressline1] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setAddressline1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressline1 !== $v) {
            $this->addressline1 = $v;
            $this->modifiedColumns[CustomersTableMap::COL_ADDRESSLINE1] = true;
        }

        return $this;
    } // setAddressline1()

    /**
     * Set the value of [addressline2] column.
     *
     * @param string|null $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setAddressline2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressline2 !== $v) {
            $this->addressline2 = $v;
            $this->modifiedColumns[CustomersTableMap::COL_ADDRESSLINE2] = true;
        }

        return $this;
    } // setAddressline2()

    /**
     * Set the value of [city] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [state] column.
     *
     * @param string|null $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[CustomersTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Set the value of [postalcode] column.
     *
     * @param string|null $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setPostalcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postalcode !== $v) {
            $this->postalcode = $v;
            $this->modifiedColumns[CustomersTableMap::COL_POSTALCODE] = true;
        }

        return $this;
    } // setPostalcode()

    /**
     * Set the value of [country] column.
     *
     * @param string $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[CustomersTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [salesrepemployeenumber] column.
     *
     * @param int|null $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setSalesrepemployeenumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->salesrepemployeenumber !== $v) {
            $this->salesrepemployeenumber = $v;
            $this->modifiedColumns[CustomersTableMap::COL_SALESREPEMPLOYEENUMBER] = true;
        }

        if ($this->aEmployees !== null && $this->aEmployees->getEmployeenumber() !== $v) {
            $this->aEmployees = null;
        }

        return $this;
    } // setSalesrepemployeenumber()

    /**
     * Set the value of [creditlimit] column.
     *
     * @param string|null $v New value
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function setCreditlimit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->creditlimit !== $v) {
            $this->creditlimit = $v;
            $this->modifiedColumns[CustomersTableMap::COL_CREDITLIMIT] = true;
        }

        return $this;
    } // setCreditlimit()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CustomersTableMap::translateFieldName('Customernumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customernumber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CustomersTableMap::translateFieldName('Customername', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customername = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CustomersTableMap::translateFieldName('Contactlastname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contactlastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CustomersTableMap::translateFieldName('Contactfirstname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contactfirstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CustomersTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CustomersTableMap::translateFieldName('Addressline1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressline1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CustomersTableMap::translateFieldName('Addressline2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressline2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CustomersTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CustomersTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CustomersTableMap::translateFieldName('Postalcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postalcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CustomersTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CustomersTableMap::translateFieldName('Salesrepemployeenumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salesrepemployeenumber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CustomersTableMap::translateFieldName('Creditlimit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->creditlimit = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = CustomersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Customers'), 0, $e);
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
        if ($this->aEmployees !== null && $this->salesrepemployeenumber !== $this->aEmployees->getEmployeenumber()) {
            $this->aEmployees = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CustomersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCustomersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmployees = null;
            $this->collOrderss = null;

            $this->collPaymentss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Customers::setDeleted()
     * @see Customers::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCustomersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomersTableMap::DATABASE_NAME);
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
                CustomersTableMap::addInstanceToPool($this);
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

            if ($this->aEmployees !== null) {
                if ($this->aEmployees->isModified() || $this->aEmployees->isNew()) {
                    $affectedRows += $this->aEmployees->save($con);
                }
                $this->setEmployees($this->aEmployees);
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

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    \OrdersQuery::create()
                        ->filterByPrimaryKeys($this->orderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->paymentssScheduledForDeletion !== null) {
                if (!$this->paymentssScheduledForDeletion->isEmpty()) {
                    \PaymentsQuery::create()
                        ->filterByPrimaryKeys($this->paymentssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->paymentssScheduledForDeletion = null;
                }
            }

            if ($this->collPaymentss !== null) {
                foreach ($this->collPaymentss as $referrerFK) {
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
        if ($this->isColumnModified(CustomersTableMap::COL_CUSTOMERNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'customerNumber';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CUSTOMERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'customerName';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CONTACTLASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'contactLastName';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CONTACTFIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'contactFirstName';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_ADDRESSLINE1)) {
            $modifiedColumns[':p' . $index++]  = 'addressLine1';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_ADDRESSLINE2)) {
            $modifiedColumns[':p' . $index++]  = 'addressLine2';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_POSTALCODE)) {
            $modifiedColumns[':p' . $index++]  = 'postalCode';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'country';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'salesRepEmployeeNumber';
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CREDITLIMIT)) {
            $modifiedColumns[':p' . $index++]  = 'creditLimit';
        }

        $sql = sprintf(
            'INSERT INTO customers (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'customerNumber':
                        $stmt->bindValue($identifier, $this->customernumber, PDO::PARAM_INT);
                        break;
                    case 'customerName':
                        $stmt->bindValue($identifier, $this->customername, PDO::PARAM_STR);
                        break;
                    case 'contactLastName':
                        $stmt->bindValue($identifier, $this->contactlastname, PDO::PARAM_STR);
                        break;
                    case 'contactFirstName':
                        $stmt->bindValue($identifier, $this->contactfirstname, PDO::PARAM_STR);
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
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'state':
                        $stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
                        break;
                    case 'postalCode':
                        $stmt->bindValue($identifier, $this->postalcode, PDO::PARAM_STR);
                        break;
                    case 'country':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case 'salesRepEmployeeNumber':
                        $stmt->bindValue($identifier, $this->salesrepemployeenumber, PDO::PARAM_INT);
                        break;
                    case 'creditLimit':
                        $stmt->bindValue($identifier, $this->creditlimit, PDO::PARAM_STR);
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
        $pos = CustomersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCustomernumber();
                break;
            case 1:
                return $this->getCustomername();
                break;
            case 2:
                return $this->getContactlastname();
                break;
            case 3:
                return $this->getContactfirstname();
                break;
            case 4:
                return $this->getPhone();
                break;
            case 5:
                return $this->getAddressline1();
                break;
            case 6:
                return $this->getAddressline2();
                break;
            case 7:
                return $this->getCity();
                break;
            case 8:
                return $this->getState();
                break;
            case 9:
                return $this->getPostalcode();
                break;
            case 10:
                return $this->getCountry();
                break;
            case 11:
                return $this->getSalesrepemployeenumber();
                break;
            case 12:
                return $this->getCreditlimit();
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

        if (isset($alreadyDumpedObjects['Customers'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Customers'][$this->hashCode()] = true;
        $keys = CustomersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCustomernumber(),
            $keys[1] => $this->getCustomername(),
            $keys[2] => $this->getContactlastname(),
            $keys[3] => $this->getContactfirstname(),
            $keys[4] => $this->getPhone(),
            $keys[5] => $this->getAddressline1(),
            $keys[6] => $this->getAddressline2(),
            $keys[7] => $this->getCity(),
            $keys[8] => $this->getState(),
            $keys[9] => $this->getPostalcode(),
            $keys[10] => $this->getCountry(),
            $keys[11] => $this->getSalesrepemployeenumber(),
            $keys[12] => $this->getCreditlimit(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEmployees) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employees';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employees';
                        break;
                    default:
                        $key = 'Employees';
                }

                $result[$key] = $this->aEmployees->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPaymentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'paymentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'paymentss';
                        break;
                    default:
                        $key = 'Paymentss';
                }

                $result[$key] = $this->collPaymentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Customers
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CustomersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Customers
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCustomernumber($value);
                break;
            case 1:
                $this->setCustomername($value);
                break;
            case 2:
                $this->setContactlastname($value);
                break;
            case 3:
                $this->setContactfirstname($value);
                break;
            case 4:
                $this->setPhone($value);
                break;
            case 5:
                $this->setAddressline1($value);
                break;
            case 6:
                $this->setAddressline2($value);
                break;
            case 7:
                $this->setCity($value);
                break;
            case 8:
                $this->setState($value);
                break;
            case 9:
                $this->setPostalcode($value);
                break;
            case 10:
                $this->setCountry($value);
                break;
            case 11:
                $this->setSalesrepemployeenumber($value);
                break;
            case 12:
                $this->setCreditlimit($value);
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
     * @return     $this|\Customers
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CustomersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCustomernumber($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCustomername($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setContactlastname($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setContactfirstname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPhone($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAddressline1($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddressline2($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCity($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setState($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPostalcode($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCountry($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setSalesrepemployeenumber($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreditlimit($arr[$keys[12]]);
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
     * @return $this|\Customers The current object, for fluid interface
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
        $criteria = new Criteria(CustomersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CustomersTableMap::COL_CUSTOMERNUMBER)) {
            $criteria->add(CustomersTableMap::COL_CUSTOMERNUMBER, $this->customernumber);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CUSTOMERNAME)) {
            $criteria->add(CustomersTableMap::COL_CUSTOMERNAME, $this->customername);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CONTACTLASTNAME)) {
            $criteria->add(CustomersTableMap::COL_CONTACTLASTNAME, $this->contactlastname);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CONTACTFIRSTNAME)) {
            $criteria->add(CustomersTableMap::COL_CONTACTFIRSTNAME, $this->contactfirstname);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_PHONE)) {
            $criteria->add(CustomersTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_ADDRESSLINE1)) {
            $criteria->add(CustomersTableMap::COL_ADDRESSLINE1, $this->addressline1);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_ADDRESSLINE2)) {
            $criteria->add(CustomersTableMap::COL_ADDRESSLINE2, $this->addressline2);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CITY)) {
            $criteria->add(CustomersTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_STATE)) {
            $criteria->add(CustomersTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_POSTALCODE)) {
            $criteria->add(CustomersTableMap::COL_POSTALCODE, $this->postalcode);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_COUNTRY)) {
            $criteria->add(CustomersTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER)) {
            $criteria->add(CustomersTableMap::COL_SALESREPEMPLOYEENUMBER, $this->salesrepemployeenumber);
        }
        if ($this->isColumnModified(CustomersTableMap::COL_CREDITLIMIT)) {
            $criteria->add(CustomersTableMap::COL_CREDITLIMIT, $this->creditlimit);
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
        $criteria = ChildCustomersQuery::create();
        $criteria->add(CustomersTableMap::COL_CUSTOMERNUMBER, $this->customernumber);

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
        $validPk = null !== $this->getCustomernumber();

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
        return $this->getCustomernumber();
    }

    /**
     * Generic method to set the primary key (customernumber column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCustomernumber($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCustomernumber();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Customers (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCustomernumber($this->getCustomernumber());
        $copyObj->setCustomername($this->getCustomername());
        $copyObj->setContactlastname($this->getContactlastname());
        $copyObj->setContactfirstname($this->getContactfirstname());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setAddressline1($this->getAddressline1());
        $copyObj->setAddressline2($this->getAddressline2());
        $copyObj->setCity($this->getCity());
        $copyObj->setState($this->getState());
        $copyObj->setPostalcode($this->getPostalcode());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setSalesrepemployeenumber($this->getSalesrepemployeenumber());
        $copyObj->setCreditlimit($this->getCreditlimit());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPaymentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPayments($relObj->copy($deepCopy));
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
     * @return \Customers Clone of current object.
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
     * Declares an association between this object and a ChildEmployees object.
     *
     * @param  ChildEmployees|null $v
     * @return $this|\Customers The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEmployees(ChildEmployees $v = null)
    {
        if ($v === null) {
            $this->setSalesrepemployeenumber(NULL);
        } else {
            $this->setSalesrepemployeenumber($v->getEmployeenumber());
        }

        $this->aEmployees = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployees object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployees object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEmployees|null The associated ChildEmployees object.
     * @throws PropelException
     */
    public function getEmployees(ConnectionInterface $con = null)
    {
        if ($this->aEmployees === null && ($this->salesrepemployeenumber != 0)) {
            $this->aEmployees = ChildEmployeesQuery::create()->findPk($this->salesrepemployeenumber, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployees->addCustomerss($this);
             */
        }

        return $this->aEmployees;
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
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('Payments' === $relationName) {
            $this->initPaymentss();
            return;
        }
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     */
    public function resetPartialOrderss($v = true)
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss($overrideExisting = true)
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCustomers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @throws PropelException
     */
    public function getOrderss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByCustomers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCustomers The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setCustomers(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orders objects.
     * @throws PropelException
     */
    public function countOrderss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomers($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param  ChildOrders $l ChildOrders
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders)
    {
        $this->collOrderss[]= $orders;
        $orders->setCustomers($this);
    }

    /**
     * @param  ChildOrders $orders The ChildOrders object to remove.
     * @return $this|ChildCustomers The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= clone $orders;
            $orders->setCustomers(null);
        }

        return $this;
    }

    /**
     * Clears out the collPaymentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPaymentss()
     */
    public function clearPaymentss()
    {
        $this->collPaymentss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPaymentss collection loaded partially.
     */
    public function resetPartialPaymentss($v = true)
    {
        $this->collPaymentssPartial = $v;
    }

    /**
     * Initializes the collPaymentss collection.
     *
     * By default this just sets the collPaymentss collection to an empty array (like clearcollPaymentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPaymentss($overrideExisting = true)
    {
        if (null !== $this->collPaymentss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PaymentsTableMap::getTableMap()->getCollectionClassName();

        $this->collPaymentss = new $collectionClassName;
        $this->collPaymentss->setModel('\Payments');
    }

    /**
     * Gets an array of ChildPayments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCustomers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPayments[] List of ChildPayments objects
     * @throws PropelException
     */
    public function getPaymentss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPaymentssPartial && !$this->isNew();
        if (null === $this->collPaymentss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPaymentss) {
                    $this->initPaymentss();
                } else {
                    $collectionClassName = PaymentsTableMap::getTableMap()->getCollectionClassName();

                    $collPaymentss = new $collectionClassName;
                    $collPaymentss->setModel('\Payments');

                    return $collPaymentss;
                }
            } else {
                $collPaymentss = ChildPaymentsQuery::create(null, $criteria)
                    ->filterByCustomers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPaymentssPartial && count($collPaymentss)) {
                        $this->initPaymentss(false);

                        foreach ($collPaymentss as $obj) {
                            if (false == $this->collPaymentss->contains($obj)) {
                                $this->collPaymentss->append($obj);
                            }
                        }

                        $this->collPaymentssPartial = true;
                    }

                    return $collPaymentss;
                }

                if ($partial && $this->collPaymentss) {
                    foreach ($this->collPaymentss as $obj) {
                        if ($obj->isNew()) {
                            $collPaymentss[] = $obj;
                        }
                    }
                }

                $this->collPaymentss = $collPaymentss;
                $this->collPaymentssPartial = false;
            }
        }

        return $this->collPaymentss;
    }

    /**
     * Sets a collection of ChildPayments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $paymentss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCustomers The current object (for fluent API support)
     */
    public function setPaymentss(Collection $paymentss, ConnectionInterface $con = null)
    {
        /** @var ChildPayments[] $paymentssToDelete */
        $paymentssToDelete = $this->getPaymentss(new Criteria(), $con)->diff($paymentss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->paymentssScheduledForDeletion = clone $paymentssToDelete;

        foreach ($paymentssToDelete as $paymentsRemoved) {
            $paymentsRemoved->setCustomers(null);
        }

        $this->collPaymentss = null;
        foreach ($paymentss as $payments) {
            $this->addPayments($payments);
        }

        $this->collPaymentss = $paymentss;
        $this->collPaymentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Payments objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Payments objects.
     * @throws PropelException
     */
    public function countPaymentss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPaymentssPartial && !$this->isNew();
        if (null === $this->collPaymentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPaymentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPaymentss());
            }

            $query = ChildPaymentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomers($this)
                ->count($con);
        }

        return count($this->collPaymentss);
    }

    /**
     * Method called to associate a ChildPayments object to this object
     * through the ChildPayments foreign key attribute.
     *
     * @param  ChildPayments $l ChildPayments
     * @return $this|\Customers The current object (for fluent API support)
     */
    public function addPayments(ChildPayments $l)
    {
        if ($this->collPaymentss === null) {
            $this->initPaymentss();
            $this->collPaymentssPartial = true;
        }

        if (!$this->collPaymentss->contains($l)) {
            $this->doAddPayments($l);

            if ($this->paymentssScheduledForDeletion and $this->paymentssScheduledForDeletion->contains($l)) {
                $this->paymentssScheduledForDeletion->remove($this->paymentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPayments $payments The ChildPayments object to add.
     */
    protected function doAddPayments(ChildPayments $payments)
    {
        $this->collPaymentss[]= $payments;
        $payments->setCustomers($this);
    }

    /**
     * @param  ChildPayments $payments The ChildPayments object to remove.
     * @return $this|ChildCustomers The current object (for fluent API support)
     */
    public function removePayments(ChildPayments $payments)
    {
        if ($this->getPaymentss()->contains($payments)) {
            $pos = $this->collPaymentss->search($payments);
            $this->collPaymentss->remove($pos);
            if (null === $this->paymentssScheduledForDeletion) {
                $this->paymentssScheduledForDeletion = clone $this->collPaymentss;
                $this->paymentssScheduledForDeletion->clear();
            }
            $this->paymentssScheduledForDeletion[]= clone $payments;
            $payments->setCustomers(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aEmployees) {
            $this->aEmployees->removeCustomers($this);
        }
        $this->customernumber = null;
        $this->customername = null;
        $this->contactlastname = null;
        $this->contactfirstname = null;
        $this->phone = null;
        $this->addressline1 = null;
        $this->addressline2 = null;
        $this->city = null;
        $this->state = null;
        $this->postalcode = null;
        $this->country = null;
        $this->salesrepemployeenumber = null;
        $this->creditlimit = null;
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
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPaymentss) {
                foreach ($this->collPaymentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderss = null;
        $this->collPaymentss = null;
        $this->aEmployees = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CustomersTableMap::DEFAULT_STRING_FORMAT);
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
