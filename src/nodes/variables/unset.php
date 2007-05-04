<?php
/**
 * File containing the ezcWorkflowNodeVariableUnset class.
 *
 * @package Workflow
 * @version //autogen//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * This node unsets a workflow variable.
 *
 * @package Workflow
 * @version //autogen//
 */
class ezcWorkflowNodeVariableUnset extends ezcWorkflowNode
{
    /**
     * Constructor.
     *
     * @param mixed $configuration
     * @throws InvalidArgumentException
     */
    public function __construct( $configuration = '' )
    {
        if ( is_string( $configuration ) )
        {
            $configuration = array( $configuration );
        }

        if ( !is_array( $configuration ) )
        {
            throw new InvalidArgumentException;
        }

        parent::__construct( $configuration );
    }

    /**
     * Executes this node.
     *
     * @param ezcWorkflowExecution $execution
     */
    public function execute( ezcWorkflowExecution $execution )
    {
        foreach ( $this->configuration as $variable )
        {
            $execution->unsetVariable( $variable );
        }

        $this->activateNode( $execution, $this->outNodes[0] );

        return parent::execute( $execution );
    }

    /**
     * Returns a textual representation of this node.
     *
     * @return string
     */
    public function __toString()
    {
        return 'unset(' . implode( ', ', $this->configuration ) . ')';
    }
}
?>
