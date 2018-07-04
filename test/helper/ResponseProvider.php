<?php

class ResponseProvider
{
    public static function getPaypalSuccessResponse()
    {
        return base64_encode("<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> <payment xmlns=\"http://www.elastic-payments.com/schema/payment\"> <merchant-account-id>be17476f-1a0c-442e-8841-70e33996c0aa</merchant-account-id> <transaction-id>4e3b9261-4a82-47df-8795-ae5353dd9ee3</transaction-id> <request-id>8f2906ea-21ba-4afb-be75-54dd4439403a</request-id> <transaction-type>authorization</transaction-type> <transaction-state>success</transaction-state> <completion-time-stamp>2018-04-11T09:29:27.000Z</completion-time-stamp> <statuses> <status code=\"201.0000\" description=\"The resource was successfully created.\" severity=\"information\" provider-transaction-id=\"2EV690760Y9874511\"/> </statuses> <requested-amount currency=\"EUR\">1.15</requested-amount> <parent-transaction-id>f605cbe3-5e05-4de7-b854-ce37445d00e6</parent-transaction-id> <account-holder> <first-name>Wirecardbuyer</first-name> <last-name>Spintzyk</last-name> <email>paypal.buyer2@wirecard.com</email> </account-holder> <descriptor>customerStatement 18009998888</descriptor> <custom-fields/> <payment-methods> <payment-method name=\"paypal\"/> </payment-methods> <api-id>---</api-id> <cancel-redirect-url>https://demoshop-test.wirecard.com/demoshop/#!/cancel</cancel-redirect-url> <success-redirect-url>https://demoshop-test.wirecard.com/demoshop/#!/success</success-redirect-url> <fail-redirect-url>https://demoshop-test.wirecard.com/demoshop/#!/error</fail-redirect-url> <wallet> <account-id>ZNKTXUBNSQE2Y</account-id> </wallet> </payment>");
    }

    public static function  getPaypalFailureResponse()
    {
        return base64_encode("<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> <payment xmlns=\"http://www.elastic-payments.com/schema/payment\" xmlns:ns2=\"http://www.elastic-payments.com/schema/epa/transaction\"> <merchant-account-id>be17476f-1a0c-442e-8841-70e33996c0aa</merchant-account-id> <transaction-id>7f26b332-eb32-48fc-8580-6ad162713804</transaction-id> <request-id>f997b1dc-c996-431a-a403-bbeab26f873c</request-id> <transaction-type>authorization</transaction-type> <transaction-state>failed</transaction-state> <completion-time-stamp>2018-04-12T09:18:03.000Z</completion-time-stamp> <statuses> <status code=\"400.1013\" description=\"The Requested Amount is below the minimum required for this Merchant Account.  Please check your input and try again.\" severity=\"error\" /> </statuses> <requested-amount currency=\"EUR\">0.00</requested-amount> <account-holder> <first-name>Wirecardbuyer</first-name> <last-name>Spintzyk</last-name> <email>paypal.buyer2@wirecard.com</email> </account-holder> <shipping> <first-name>Jack</first-name> <last-name>Jones</last-name> <phone>+49123123123</phone> <address> <street1>123 anystreet</street1> <city>Brantford</city> <country>CA</country> <postal-code>M4P1E8</postal-code> </address> </shipping> <order-number>180412111803918</order-number> <descriptor>customerStatement 18009998888</descriptor> <payment-methods> <payment-method name=\"paypal\" /> </payment-methods> <cancel-redirect-url>https://demoshop-test.wirecard.com/demoshop/#!/cancel</cancel-redirect-url> <success-redirect-url>https://demoshop-test.wirecard.com/demoshop/#!/success</success-redirect-url> </payment>");
    }
}