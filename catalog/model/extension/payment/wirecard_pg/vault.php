<?php
/**
 * Shop System Plugins:
 * - Terms of Use can be found under:
 * https://github.com/wirecard/opencart-ee/blob/master/_TERMS_OF_USE
 * - License can be found under:
 * https://github.com/wirecard/opencart-ee/blob/master/LICENSE
 */

/**
 * Class ModelExtensionPaymentWirecardPGVault
 *
 * @since 1.1.0
 */
class ModelExtensionPaymentWirecardPGVault extends Model {

	/**
	 * Get all Credit Cards associated with a user.
	 *
	 * @param \Cart\Customer $user
	 * @return array
	 * @since 1.1.0
	 */
	public function getCards($user) {
		return $this->db->query(
			"SELECT * FROM `" . DB_PREFIX . "wirecard_ee_vault` 
			WHERE user_id=" . $user->getId() . "
			ORDER BY vault_id DESC"
		)->rows;
	}

	/**
	 * Save a Credit Card to the database.
	 *
	 * @param \Cart\Customer $user
	 * @param Wirecard\PaymentSdk\Response\SuccessResponse $response
	 * @since 1.1.0
	 */
	public function saveCard($user, $response) {
		$token = $response->getCardTokenId();
		$masked_pan = $response->getMaskedAccountNumber();

		$existing_cards = $this->getCards($user);
		if(!empty($existing_cards)) {
			foreach($existing_cards as $card) {
				if ($card['token'] == $token) {
					return;
				}
			}
		}

		$this->db->query(
			"INSERT INTO `" . DB_PREFIX . "wirecard_ee_vault` SET
			`user_id` = " . $user->getId() . ",
			`token` = '" . $this->db->escape($token) . "',
			`masked_pan` = '" . $this->db->escape($masked_pan) . "';"
		);
	}

	/**
	 * Delete a Credit Card from the database.
	 *
	 * @param \Cart\Customer $user
	 * @param $card_id
	 * @return bool
	 * @since 1.1.0
	 */
	public function deleteCard($user, $card_id) {
		return $this->db->query(
			"DELETE FROM `" . DB_PREFIX . "wirecard_ee_vault` 
			WHERE user_id=" . $user->getId() . "
			AND vault_id=" . $this->db->escape($card_id) . ";"
		);
	}
}
