<?php
declare(strict_types=1);

namespace respund\collector\factories;

use Ramsey\Uuid\Uuid;
use respund\collector\exceptions\RespundException;
use respund\collector\models\Language;
use respund\collector\models\Respondent;
use respund\collector\models\Setting;
use respund\collector\models\Status;
use respund\collector\models\Survey;
use respund\collector\traits\ApplicationAwareTrait;

class RespondentFactory
{
    use ApplicationAwareTrait;
    
    const INCREASE_LENGTH_LIMIT = 15; // must be less than FIND_KEY_LOOP_LIMIT
    const FIND_KEY_LOOP_LIMIT = 16;
    private int $keyLength = 1;

    public function makeBase(Survey $survey, ?string $key = null) : Respondent
    {

        if(empty($key)) {
            $key = $this->generateKey();
        }
        $model = new Respondent([
            'key' => $key,
            'survey_id' => $survey->primaryKey,
            'uuid' => Uuid::uuid4()->toString(),
            'status_id' => Status::CREATED,
            'language_id' => Language::ESTONIAN
        ]);
        if(!$model->save()) {
            throw new RespundException("Error saving respondent: ". json_encode($model->errors));
        }
        return $model;

    }




    private function generateKey() : string
    {
        $setting = (new Setting())->findByName(Setting::KEY_LENGTH);

        $this->keyLength = intval($setting->value);
        $context = [
            'length' => $this->keyLength,
        ];

        $j=0;
        for($i = 0 ; $i < self::FIND_KEY_LOOP_LIMIT; $i++) {
            $j++;
            if ($j > self::INCREASE_LENGTH_LIMIT) {
                $this->keyLength++;
                $setting->value = strval($this->keyLength);
                $setting->save();
                $context['length'] = $this->keyLength;
                $this->getApp()->warning('Key-genValue.increase-length', $context);
            }

            $value = $this->value();
            $context['value'] = $value;
            $result = (new Respondent())->findByKey($value);
            if (empty($result)) {
                $this->getApp()->debug('Key-genValue.ok-unused-key', $context);
                return $value;
            }
            $this->getApp()->debug('Key-genValue.duplicate-key', $context);
        }

        throw new RespundException('Can not find an unique key, contact system owner');

    }

    /**
     * @return string
     */
    private function value() : string
    {
        $this->getApp()->debug('generate-key');

        // not including 0-s and l s
        $permitted_chars = '123456789abcdefghijkmnopqrstuvwxyz';
        $charactersLength = strlen($permitted_chars);
        $code = "";
        for($x=0; $x< $this->keyLength; $x++) {
            $code .= $permitted_chars[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

}