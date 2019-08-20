<?php
namespace PhpNwSykes;

class RomanNumeral
{
    protected $symbols = [
        1000 => 'M',
        500 => 'D',
        100 => 'C',
        50 => 'L',
        10 => 'X',
        5 => 'V',
        1 => 'I',
    ];

    protected $numeral;

    public function __construct(string $romanNumeral)
    {
        $this->numeral = $romanNumeral;
    }

    /**
     * Converts a roman numeral such as 'X' to a number, 10
     *
     * @throws InvalidNumeral on failure (when a numeral is invalid)
     */
    public function toInt():int
    {
        // initialise variables
        $total = 0;
        $prev_value;
        
        foreach(str_split($this->numeral) as $value) // Split input to individual characters
        {
            if (in_array($value, $this->symbols)) // Check numeral is in symbols list
            {
                if (isset($prev_value) && array_search($prev_value, $this->symbols) < array_search($value, $this->symbols)) //check for smaller previous values eg. IV, IX
                {
                    $total -= array_search($prev_value, $this->symbols); // Remove past value from total
                    $total += array_search($value, $this->symbols) - array_search($prev_value, $this->symbols); // Add new value to total
                }
                else
                {
                    $total += array_search($value, $this->symbols); // Add value of numeral to total
                }
                
                $prev_value = $value; // Keep track of previous value for case of smaller value preceding larger value
            }
            else // Value not a numeral
            {
                throw new InvalidNumeral; // Throw error
            }
        }

        return $total; // Return total value
    }
}
