<?php

namespace HookFetes\Model\Base;

use \Exception;
use \PDO;
use HookFetes\Model\DateFete as ChildDateFete;
use HookFetes\Model\DateFeteQuery as ChildDateFeteQuery;
use HookFetes\Model\Map\DateFeteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'date_fete' table.
 *
 *
 *
 * @method     ChildDateFeteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDateFeteQuery orderByDebut($order = Criteria::ASC) Order by the debut column
 * @method     ChildDateFeteQuery orderByFin($order = Criteria::ASC) Order by the fin column
 *
 * @method     ChildDateFeteQuery groupById() Group by the id column
 * @method     ChildDateFeteQuery groupByDebut() Group by the debut column
 * @method     ChildDateFeteQuery groupByFin() Group by the fin column
 *
 * @method     ChildDateFeteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDateFeteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDateFeteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDateFeteQuery leftJoinAgendaFetes($relationAlias = null) Adds a LEFT JOIN clause to the query using the AgendaFetes relation
 * @method     ChildDateFeteQuery rightJoinAgendaFetes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AgendaFetes relation
 * @method     ChildDateFeteQuery innerJoinAgendaFetes($relationAlias = null) Adds a INNER JOIN clause to the query using the AgendaFetes relation
 *
 * @method     ChildDateFete findOne(ConnectionInterface $con = null) Return the first ChildDateFete matching the query
 * @method     ChildDateFete findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDateFete matching the query, or a new ChildDateFete object populated from the query conditions when no match is found
 *
 * @method     ChildDateFete findOneById(int $id) Return the first ChildDateFete filtered by the id column
 * @method     ChildDateFete findOneByDebut(string $debut) Return the first ChildDateFete filtered by the debut column
 * @method     ChildDateFete findOneByFin(string $fin) Return the first ChildDateFete filtered by the fin column
 *
 * @method     array findById(int $id) Return ChildDateFete objects filtered by the id column
 * @method     array findByDebut(string $debut) Return ChildDateFete objects filtered by the debut column
 * @method     array findByFin(string $fin) Return ChildDateFete objects filtered by the fin column
 *
 */
abstract class DateFeteQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \HookFetes\Model\Base\DateFeteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\HookFetes\\Model\\DateFete', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDateFeteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDateFeteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \HookFetes\Model\DateFeteQuery) {
            return $criteria;
        }
        $query = new \HookFetes\Model\DateFeteQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDateFete|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DateFeteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DateFeteTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildDateFete A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, DEBUT, FIN FROM date_fete WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildDateFete();
            $obj->hydrate($row);
            DateFeteTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDateFete|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DateFeteTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DateFeteTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DateFeteTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DateFeteTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateFeteTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the debut column
     *
     * Example usage:
     * <code>
     * $query->filterByDebut('2011-03-14'); // WHERE debut = '2011-03-14'
     * $query->filterByDebut('now'); // WHERE debut = '2011-03-14'
     * $query->filterByDebut(array('max' => 'yesterday')); // WHERE debut > '2011-03-13'
     * </code>
     *
     * @param     mixed $debut The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterByDebut($debut = null, $comparison = null)
    {
        if (is_array($debut)) {
            $useMinMax = false;
            if (isset($debut['min'])) {
                $this->addUsingAlias(DateFeteTableMap::DEBUT, $debut['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($debut['max'])) {
                $this->addUsingAlias(DateFeteTableMap::DEBUT, $debut['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateFeteTableMap::DEBUT, $debut, $comparison);
    }

    /**
     * Filter the query on the fin column
     *
     * Example usage:
     * <code>
     * $query->filterByFin('2011-03-14'); // WHERE fin = '2011-03-14'
     * $query->filterByFin('now'); // WHERE fin = '2011-03-14'
     * $query->filterByFin(array('max' => 'yesterday')); // WHERE fin > '2011-03-13'
     * </code>
     *
     * @param     mixed $fin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterByFin($fin = null, $comparison = null)
    {
        if (is_array($fin)) {
            $useMinMax = false;
            if (isset($fin['min'])) {
                $this->addUsingAlias(DateFeteTableMap::FIN, $fin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fin['max'])) {
                $this->addUsingAlias(DateFeteTableMap::FIN, $fin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateFeteTableMap::FIN, $fin, $comparison);
    }

    /**
     * Filter the query by a related \HookFetes\Model\AgendaFetes object
     *
     * @param \HookFetes\Model\AgendaFetes|ObjectCollection $agendaFetes  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function filterByAgendaFetes($agendaFetes, $comparison = null)
    {
        if ($agendaFetes instanceof \HookFetes\Model\AgendaFetes) {
            return $this
                ->addUsingAlias(DateFeteTableMap::ID, $agendaFetes->getDateId(), $comparison);
        } elseif ($agendaFetes instanceof ObjectCollection) {
            return $this
                ->useAgendaFetesQuery()
                ->filterByPrimaryKeys($agendaFetes->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAgendaFetes() only accepts arguments of type \HookFetes\Model\AgendaFetes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AgendaFetes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function joinAgendaFetes($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AgendaFetes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AgendaFetes');
        }

        return $this;
    }

    /**
     * Use the AgendaFetes relation AgendaFetes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \HookFetes\Model\AgendaFetesQuery A secondary query class using the current class as primary query
     */
    public function useAgendaFetesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAgendaFetes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AgendaFetes', '\HookFetes\Model\AgendaFetesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDateFete $dateFete Object to remove from the list of results
     *
     * @return ChildDateFeteQuery The current query, for fluid interface
     */
    public function prune($dateFete = null)
    {
        if ($dateFete) {
            $this->addUsingAlias(DateFeteTableMap::ID, $dateFete->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the date_fete table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DateFeteTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DateFeteTableMap::clearInstancePool();
            DateFeteTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildDateFete or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildDateFete object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DateFeteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DateFeteTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        DateFeteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DateFeteTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // DateFeteQuery
