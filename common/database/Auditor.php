<?php
/**
 * This class is responsible for shuttling SQL queries to the audit table. All
 * work is delegated to the existing SQL auditing function `auditSQLEvent` in
 * `library/log.inc`.
 *
 */

namespace OpenEMR\Common\Database;

use \Doctrine\DBAL\Logging\SQLLogger;
use OpenEMR\Common\Logging\Logger;

final class Auditor implements SQLLogger
{
    /**
     * Executed SQL queries with the following keys in each inner object:
     *
     * `params`: The optional param values for the current SQL query.
     * `sql`: The raw SQL for the current SQL query (shows `?` for params if given).
     *
     * @note a query will be removed from the dictionary once complete.
     */
    public $queries = array();

    /**
     * Index of the current query in the $queries dictionary.
     */
    public $currentQueryIndex = 0;

    /**
     * Logger for noting sql query information.
     */
    private $logger;

    /**
     * Default constructor. This is here for completeness, it is
     * essentially a no-op.
     */
    public function __construct()
    {
        $this->logger = new Logger("\OpenEMR\Common\Database\Auditor");
    }

    /**
     * Intercepts the SQL query to be performed by the ORM.
     *
     * @param $sql the raw SQL (shows `?` for params if given).
     * @param $params the optional param values for the SQL.
     * @param $types the optional param types.
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->queries[++$this->currentQueryIndex] = array('sql' => $sql, 'params' => $params);
        $this->logger->trace("sql: " . $sql);
    }

    /**
     * Triggers when an SQL query has been performed and sends
     * the information to the audit table.
     *
     * @note this is only called if the query succeeded.
     * @note the query is from the dictionary once complete at this point.
     */
    public function stopQuery()
    {
        $sql = $this->queries[$this->currentQueryIndex]['sql'];
        $params = $this->queries[$this->currentQueryIndex]['params'];
        auditSQLEvent($sql, true, $params);
        unset($this->queries[$this->currentQueryIndex]);
    }
}
