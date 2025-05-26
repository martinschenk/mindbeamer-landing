<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MarketingConsent Model
 * 
 * Speichert die Marketingeinwilligungen der Benutzer für DSGVO-Konformität
 * 
 * @property int $id
 * @property string $email
 * @property bool $consent_given
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $locale
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class MarketingConsent extends Model
{
    use HasFactory;
    
    /**
     * Die Attribute, die zugewiesen werden können.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'email',
        'consent_given',
        'ip_address',
        'user_agent',
        'locale',
    ];
    
    /**
     * Die Attribute, die konvertiert werden sollen.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'consent_given' => 'boolean',
    ];
}
