<?php
/**
 * File containing the ezcWorkflowNodeSynchronization class.
 *
 * @package Workflow
 * @version //autogen//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * This node implements the Synchronization (AND-Join) workflow pattern.
 *
 * The Synchronization workflow pattern synchronizes multiple parallel threads of execution
 * into a single thread of execution.
 *
 * Workflow execution continues once all threads of execution that are to be synchronized have
 * finished executing (exactly once).
 *
 * Use Case Example: After the confirmation email has been sent and the shipping process has
 * been completed, the order can be archived.
 *
 * Incomming nodes: 2..*
 * Outgoing nodes: 1
 *
 * @todo example
 * @package Workflow
 * @version //autogen//
 */
class ezcWorkflowNodeSynchronization extends ezcWorkflowNodeMerge
{
    /**
     * Activate this node.
     *
     * @param ezcWorkflowExecution $execution
     * @param ezcWorkflowNode $activatedFrom
     * @param integer $threadId
     */
    public function activate( ezcWorkflowExecution $execution, ezcWorkflowNode $activatedFrom = null, $threadId = 0 )
    {
        $this->prepareActivate( $execution, $threadId );

        $parentThreadId = $execution->getParentThreadId( $threadId );

        if ( count( $this->state ) == $execution->getNumSiblingThreads( $threadId ) )
        {
            parent::activate( $execution, $activatedFrom, $parentThreadId );
        }
    }

    /**
     * Executes this node.
     *
     * @param ezcWorkflowExecution $execution
     */
    public function execute( ezcWorkflowExecution $execution )
    {
        return $this->doMerge( $execution );
    }
}
?>
