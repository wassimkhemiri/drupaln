<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

class ClassConstFetch extends Expr
{
    /** @var Name|Expr Class name */
    public $class;
<<<<<<< HEAD
    /** @var Identifier|Expr|Error Constant name */
=======
    /** @var Identifier|Error Constant name */
>>>>>>> origin/main
    public $name;

    /**
     * Constructs a class const fetch node.
     *
<<<<<<< HEAD
     * @param Name|Expr                    $class      Class name
     * @param string|Identifier|Expr|Error $name       Constant name
     * @param array                        $attributes Additional attributes
=======
     * @param Name|Expr               $class      Class name
     * @param string|Identifier|Error $name       Constant name
     * @param array                   $attributes Additional attributes
>>>>>>> origin/main
     */
    public function __construct($class, $name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->class = $class;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
    }

    public function getSubNodeNames() : array {
        return ['class', 'name'];
    }
<<<<<<< HEAD

=======
    
>>>>>>> origin/main
    public function getType() : string {
        return 'Expr_ClassConstFetch';
    }
}
