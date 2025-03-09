<?php

namespace App\Helpers\Firebase;

use App\Models\Product;
use Kreait\Firebase\Exception\DatabaseException;
use Kreait\Firebase\Factory;

class FirebaseHelper
{
    public static function updateBiddingData(Product $product): void
    {
        $serviceAccount = config('firebase.projects.app.credentials');
        $databaseUrl = config('firebase.projects.app.database.url');

        try {
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->withDatabaseUri($databaseUrl)
                ->createDatabase();

            $firebaseRef = $firebase->getReference('products');
            $uniqueId = uniqid('product_', true);

            $firebaseRef->update([
                $product->id => $uniqueId
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to update Firebase bidding data: ' . $e->getMessage());
        } catch (DatabaseException $e) {
            \Log::error('Firebase Database exception: ' . $e->getMessage());
        }
    }
}
