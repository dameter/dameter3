<?php
declare(strict_types=1);

namespace respund\collector\services;

use respund\collector\exceptions\RespundException;
use respund\collector\factories\RespondentFactory;
use respund\collector\models\Survey;
use respund\collector\traits\ApplicationAwareTrait;

class RespondentGenerationService
{
    use ApplicationAwareTrait;

    /**
     * @var array<string>
     */
    private array $keys = [];

    public function __construct(private readonly Survey $survey, private readonly int $amount)
    {
        if($this->amount == 0) {
            throw new RespundException("amount needs to be > 0");
        }
    }

    public function run() : void{
        for ($x=0;$x<$this->amount; $x++){
            $model = (new RespondentFactory())->makeBase($this->survey);
            $this->keys[] = $model->key;
        }
        $this->getApp()->info("generated keys:". json_encode($this->keys));
    }

}