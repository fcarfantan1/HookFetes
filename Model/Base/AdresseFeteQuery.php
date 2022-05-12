<?php

namespace HookFetes\Model\Base;

use \Exception;
use \PDO;
use HookFetes\Model\AdresseFete as ChildAdresseFete;
use HookFetes\Model\AdresseFeteQuery as ChildAdresseFeteQuery;
use HookFetes\Model\Map\AdresseFeteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'adresse_fete' table.
 *
 *
 *
 * @method     ChildAdresseFeteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAdresseFeteQuery orderByDepartement($order = Criteria::ASC) Order by the departement column
 * @method     ChildAdresseFeteQuery orderByVille($order = Criteria::ASC) Order by the ville column
 * @method     ChildAdresseFeteQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildAdresseFeteQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildAdresseFeteQuery orderByLien($order = Criteria::ASC) Order by the lien column
 *
 * @method     ChildAdresseFeteQuery groupById() Group by the id column
 * @method     ChildAdresseFeteQuery groupByDepartement() Group by the departement column
 * @method     ChildAdresseFeteQuery groupByVille() Group by the ville column
 * @method     ChildAdresseFeteQuery groupByTitle() Group by the title column
 * @method     ChildAdresseFeteQuery groupByDescription() Group by the description column
 * @method     ChildAdresseFeteQuery groupByLien() Group by the lien column
 *
 * @method     ChildAdresseFeteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdresseFeteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdresseFeteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdresseFeteQuery leftJoinAgendaFetes($relationAlias = null) Adds a LEFT JOIN clause to the query using the AgendaFetes relation
 * @method     ChildAdresseFeteQuery rightJoinAgendaFetes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AgendaFetes relation
 * @method     ChildAdresseFeteQuery innerJoinAgendaFetes($relationAlias = null) Adds a INNER JOIN clause to the query using the AgendaFetes relation
 *
 * @method     ChildAdresseFete findOne(ConnectionInterface $con = null) Return the first ChildAdresseFete matching the query
 * @method     ChildAdresseFete findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAdresseFete matching the query, or a new ChildAdresseFete object populated from the query conditions when no match is found
 *
 * @method     ChildAdresseFete findOneById(int $id) Return the first ChildAdresseFete filtered by the id column
 * @method     ChildAdresseFete findOneByDepartement(string $departement) Return the first ChildAdresseFete filtered by the departement column
 * @method     ChildAdresseFete findOneByVille(string $ville) Return the first ChildAdresseFete filtered by the ville column
 * @method     ChildAdresseFete findOneByTitle(string $title) Return the first ChildAdresseFete filtered by the title column
 * @method     ChildAdresseFete findOneByDescription(string $description) Return the first ChildAdresseFete filtered by the description column
 * @method     ChildAdresseFete findOneByLien(string $lien) Return the first ChildAdresseFete filtered by the lien column
 *
 * @method     array findById(int $id) Return ChildAdresseFete objects filtered by the id column
 * @method     array findByDepartement(string $departement) Return ChildAdresseFete objects filtered by the departement column
 * @method     array findByVille(string $ville) Return ChildAdresseFete objects filtered by the ville column
 * @method     array findByTitle(string $title) Return ChildAdresseFete objects filtered by the title column
 * @method     array findByDescription(string $description) Return ChildAdresseFete objects filtered by the description column
 * @method     array findByLien(string $lien) Return ChildAdresseFete objects filtered by the lien column
 *
 */
abstract class AdresseFeteQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \HookFetes\Model\Base\AdresseFeteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\HookFetes\\Model\\AdresseFete', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdresseFeteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdresseFeteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \HookFetes\Model\AdresseFeteQuery) {
            return $criteria;
        }
        $query = new \HookFetes\Model\AdresseFeteQuery();
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
     * @return ChildAdresseFete|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AdresseFeteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdresseFeteTableMap::DATABASE_NAME);
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
     * @return   ChildAdresseFete A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, DEPARTEMENT, VILLE, TITLE, DESCRIPTION, LIEN FROM adresse_fete WHERE ID = :p0';
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
            $obj = new ChildAdresseFete();
            $obj->hydrate($row);
            AdresseFeteTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAdresseFete|array|mixed the result, formatted by the current formatter
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AdresseFeteTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildAdresseFeteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AdresseFeteTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AdresseFeteTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AdresseFeteTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseFeteTableMap::ID, $id, $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AdresseFeteTableMap::DEPARTEMENT, $departement, $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AdresseFeteTableMap::VILLE, $ville, $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AdresseFeteTableMap::TITLE, $title, $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AdresseFeteTableMap::DESCRIPTION, $description, $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AdresseFeteTableMap::LIEN, $lien, $comparison);
    }

    /**
     * Filter the query by a related \HookFetes\Model\AgendaFetes object
     *
     * @param \HookFetes\Model\AgendaFetes|ObjectCollection $agendaFetes  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAdresseFeteQuery The current query, for fluid interface
     */
    public function filterByAgendaFetes($agendaFetes, $comparison = null)
    {
        if ($agendaFetes instanceof \HookFetes\Model\AgendaFetes) {
            return $this
                ->addUsingAlias(AdresseFeteTableMap::ID, $agendaFetes->getAdresseId(), $comparison);
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
     * @return ChildAdresseFeteQuery The current query, for fluid interface
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
     * @param   ChildAdresseFete $adresseFete Object to remove from the list of results
     *
     * @return ChildAdresseFeteQuery The current query, for fluid interface
     */
    public function prune($adresseFete = null)
    {
        if ($adresseFete) {
            $this->addUsingAlias(AdresseFeteTableMap::ID, $adresseFete->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the adresse_fete table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseFeteTableMap::DATABASE_NAME);
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
            AdresseFeteTableMap::clearInstancePool();
            AdresseFeteTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildAdresseFete or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildAdresseFete object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseFeteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdresseFeteTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        AdresseFeteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdresseFeteTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // AdresseFeteQuery
