<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

class ClassConst extends Node\Stmt
{
    /** @var int Modifiers */
    public $flags;
    /** @var Node\Const_[] Constant declarations */
    public $consts;
<<<<<<< HEAD
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public $attrGroups;
    /** @var Node\Identifier|Node\Name|Node\ComplexType|null Type declaration */
    public $type;
=======
    /** @var Node\AttributeGroup[] */
    public $attrGroups;
>>>>>>> origin/main

    /**
     * Constructs a class const list node.
     *
<<<<<<< HEAD
     * @param Node\Const_[]                                          $consts     Constant declarations
     * @param int                                                    $flags      Modifiers
     * @param array                                                  $attributes Additional attributes
     * @param Node\AttributeGroup[]                                  $attrGroups PHP attribute groups
     * @param null|string|Node\Identifier|Node\Name|Node\ComplexType $type       Type declaration
=======
     * @param Node\Const_[]         $consts     Constant declarations
     * @param int                   $flags      Modifiers
     * @param array                 $attributes Additional attributes
     * @param Node\AttributeGroup[] $attrGroups PHP attribute groups
>>>>>>> origin/main
     */
    public function __construct(
        array $consts,
        int $flags = 0,
        array $attributes = [],
<<<<<<< HEAD
        array $attrGroups = [],
        $type = null
=======
        array $attrGroups = []
>>>>>>> origin/main
    ) {
        $this->attributes = $attributes;
        $this->flags = $flags;
        $this->consts = $consts;
        $this->attrGroups = $attrGroups;
<<<<<<< HEAD
        $this->type = \is_string($type) ? new Node\Identifier($type) : $type;
    }

    public function getSubNodeNames() : array {
        return ['attrGroups', 'flags', 'type', 'consts'];
=======
    }

    public function getSubNodeNames() : array {
        return ['attrGroups', 'flags', 'consts'];
>>>>>>> origin/main
    }

    /**
     * Whether constant is explicitly or implicitly public.
     *
     * @return bool
     */
    public function isPublic() : bool {
        return ($this->flags & Class_::MODIFIER_PUBLIC) !== 0
            || ($this->flags & Class_::VISIBILITY_MODIFIER_MASK) === 0;
    }

    /**
     * Whether constant is protected.
     *
     * @return bool
     */
    public function isProtected() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_PROTECTED);
    }

    /**
     * Whether constant is private.
     *
     * @return bool
     */
    public function isPrivate() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_PRIVATE);
    }

    /**
     * Whether constant is final.
     *
     * @return bool
     */
    public function isFinal() : bool {
        return (bool) ($this->flags & Class_::MODIFIER_FINAL);
    }

    public function getType() : string {
        return 'Stmt_ClassConst';
    }
}
