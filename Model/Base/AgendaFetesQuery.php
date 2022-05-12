<?php

namespace HookFetes\Model\Base;

use \Exception;
use \PDO;
use HookFetes\Model\AgendaFetes as ChildAgendaFetes;
use HookFetes\Model\AgendaFetesQuery as ChildAgendaFetesQuery;
use HookFetes\Model\Map\AgendaFetesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'agenda_fetes' table.
 *
 *
 *
 * @method     ChildAgendaFetesQuery orderByFetesId($order = Criteria::ASC) Order by the fetes_id column
 * @method     ChildAgendaFetesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildAgendaFetesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildAgendaFetesQuery orderByDepartement($order = Criteria::ASC) Order by the departement column
 * @method     ChildAgendaFetesQuery orderByVille($order = Criteria::ASC) Order by the ville column
 * @method     ChildAgendaFetesQuery orderByLien($order = Criteria::ASC) Order by the lien column
 * @method     ChildAgendaFetesQuery orderByDebut($order = Criteria::ASC) Order by the debut column
 * @method     ChildAgendaFetesQuery orderByFin($order = Criteria::ASC) Order by the fin column
 * @method     ChildAgendaFetesQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     ChildAgendaFetesQuery groupByFetesId() Group by the fetes_id column
 * @method     ChildAgendaFetesQuery groupByTitle() Group by the title column
 * @method     ChildAgendaFetesQuery groupByDescription() Group by the description column
 * @method     ChildAgendaFetesQuery groupByDepartement() Group by the departement column
 * @method     ChildAgendaFetesQuery groupByVille() Group by the ville column
 * @method     ChildAgendaFetesQuery groupByLien() Group by the lien column
 * @method     ChildAgendaFetesQuery groupByDebut() Group by the debut column
 * @method     ChildAgendaFetesQuery groupByFin() Group by the fin column
 * @method     ChildAgendaFetesQuery groupByPosition() Group by the position column
 *
 * @method     ChildAgendaFetesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAgendaFetesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAgendaFetesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAgendaFetes findOne(ConnectionInterface $con = null) Return the first ChildAgendaFetes matching the query
 * @method     ChildAgendaFetes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAgendaFetes matching the query, or a new ChildAgendaFetes object populated from the query conditions when no match is found
 *
 * @method     ChildAgendaFetes findOneByFetesId(int $fetes_id) Return the first ChildAgendaFetes filtered by the fetes_id column
 * @method     ChildAgendaFetes findOneByTitle(string $title) Return the first ChildAgendaFetes filtered by the title column
 * @method     ChildAgendaFetes findOneByDescription(string $description) Return the first ChildAgendaFetes filtered by the description column
 * @method     ChildAgendaFetes findOneByDepartement(string $departement) Return the first ChildAgendaFetes filtered by the departement column
 * @method     ChildAgendaFetes findOneByVille(string $ville) Return the first ChildAgendaFetes filtered by the ville column
 * @method     ChildAgendaFetes findOneByLien(string $lien) Return the first ChildAgendaFetes filtered by the lien column
 * @method     ChildAgendaFetes findOneByDebut(string $debut) Return the first ChildAgendaFetes filtered by the debut column
 * @method     ChildAgendaFetes findOneByFin(string $fin) Return the first ChildAgendaFetes filtered by the fin column
 * @method     ChildAgendaFetes findOneByPosition(int $position) Return the first ChildAgendaFetes filtered by the position column
 *
 * @method     array findByFetesId(int $fetes_id) Return ChildAgendaFetes objects filtered by the fetes_id column
 * @method     array findByTitle(string $title) Return ChildAgendaFetes objects filtered by the title column
 * @method     array findByDescription(string $description) Return ChildAgendaFetes objects filtered by the description column
 * @method     array findByDepartement(string $departement) Return ChildAgendaFetes objects filtered by the departement column
 * @method     array findByVille(string $ville) Return ChildAgendaFetes objects filtered by the ville column
 * @method     array findByLien(string $lien) Return ChildAgendaFetes objects filtered by the lien column
 * @method     array findByDebut(string $debut) Return ChildAgendaFetes objects filtered by the debut column
 * @method     array findByFin(string $fin) Return ChildAgendaFetes objects filtered by the fin column
 * @method     array findByPosition(int $position) Return ChildAgendaFetes objects filtered by the position column
 *
 */
abstract class AgendaFetesQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \HookFetes\Model\Base\AgendaFetesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\HookFetes\\Model\\AgendaFetes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAgendaFetesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAgendaFetesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \HookFetes\Model\AgendaFetesQuery) {
            return $criteria;
        }
        $query = new \HookFetes\Model\AgendaFetesQuery();
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
     * @return ChildAgendaFetes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AgendaFetesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AgendaFetesTableMap::DATABASE_NAME);
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
     * @return   ChildAgendaFetes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT FETES_ID, TITLE, DESCRIPTION, DEPARTEMENT, VILLE, LIEN, DEBUT, FIN, POSITION FROM agenda_fetes WHERE FETES_ID = :p0';
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
            $obj = new ChildAgendaFetes();
            $obj->hydrate($row);
            AgendaFetesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAgendaFetes|array|mixed the result, formatted by the current formatter
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
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fetes_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFetesId(1234); // WHERE fetes_id = 1234
     * $query->filterByFetesId(array(12, 34)); // WHERE fetes_id IN (12, 34)
     * $query->filterByFetesId(array('min' => 12)); // WHERE fetes_id > 12
     * </code>
     *
     * @param     mixed $fetesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByFetesId($fetesId = null, $comparison = null)
    {
        if (is_array($fetesId)) {
            $useMinMax = false;
            if (isset($fetesId['min'])) {
                $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $fetesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fetesId['max'])) {
                $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $fetesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $fetesId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the departement column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartement('fooValue');   // WHERE departement = 'fooValue'
     * $query->filterByDepartement('%fooValue%'); // WHERE departement LIKE '%fooValue%'
     * </code>
     *
     * @param     string $departement The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByDepartement($departement = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departement)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $departement)) {
                $departement = str_replace('*', '%', $departement);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::DEPARTEMENT, $departement, $comparison);
    }

    /**
     * Filter the query on the ville column
     *
     * Example usage:
     * <code>
     * $query->filterByVille('fooValue');   // WHERE ville = 'fooValue'
     * $query->filterByVille('%fooValue%'); // WHERE ville LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ville The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByVille($ville = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ville)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ville)) {
                $ville = str_replace('*', '%', $ville);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::VILLE, $ville, $comparison);
    }

    /**
     * Filter the query on the lien column
     *
     * Example usage:
     * <code>
     * $query->filterByLien('fooValue');   // WHERE lien = 'fooValue'
     * $query->filterByLien('%fooValue%'); // WHERE lien LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lien The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByLien($lien = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lien)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lien)) {
                $lien = str_replace('*', '%', $lien);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::LIEN, $lien, $comparison);
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
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByDebut($debut = null, $comparison = null)
    {
        if (is_array($debut)) {
            $useMinMax = false;
            if (isset($debut['min'])) {
                $this->addUsingAlias(AgendaFetesTableMap::DEBUT, $debut['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($debut['max'])) {
                $this->addUsingAlias(AgendaFetesTableMap::DEBUT, $debut['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::DEBUT, $debut, $comparison);
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
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByFin($fin = null, $comparison = null)
    {
        if (is_array($fin)) {
            $useMinMax = false;
            if (isset($fin['min'])) {
                $this->addUsingAlias(AgendaFetesTableMap::FIN, $fin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fin['max'])) {
                $this->addUsingAlias(AgendaFetesTableMap::FIN, $fin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::FIN, $fin, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(AgendaFetesTableMap::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(AgendaFetesTableMap::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AgendaFetesTableMap::POSITION, $position, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAgendaFetes $agendaFetes Object to remove from the list of results
     *
     * @return ChildAgendaFetesQuery The current query, for fluid interface
     */
    public function prune($agendaFetes = null)
    {
        if ($agendaFetes) {
            $this->addUsingAlias(AgendaFetesTableMap::FETES_ID, $agendaFetes->getFetesId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the agenda_fetes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AgendaFetesTableMap::DATABASE_NAME);
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
            AgendaFetesTableMap::clearInstancePool();
            AgendaFetesTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildAgendaFetes or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildAgendaFetes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AgendaFetesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AgendaFetesTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        AgendaFetesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AgendaFetesTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // AgendaFetesQuery
