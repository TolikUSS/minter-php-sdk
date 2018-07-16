<?php
declare(strict_types=1);

use Minter\SDK\MinterCoins\MinterCreateCoinTx;
use Minter\SDK\MinterTx;
use PHPUnit\Framework\TestCase;

/**
 * Class for testing MinterCreateCoinTx
 */
final class MinterCreateCoinTxTest extends TestCase
{
    /**
     * Predefined private key
     */
    const PRIVATE_KEY = 'b574d2a7151fcf0df573feae58015f85f6ebf38ea4b38c49196c6aceee27e189';

    /**
     * Predefined minter address
     */
    const MINTER_ADDRESS = 'Mx887c5de2515e788abb422c3e483496e1b1f3dff4';

    /**
     * Predefined data
     */
    const DATA = [
        'name' => 'SUPER TEST',
        'symbol' => 'SPRTEST',
        'initialAmount' => '100',
        'initialReserve' => '10',
        'crr' => 10
    ];

    /**
     * Predefined valid signature
     */
    const VALID_SIGNATURE = 'f874010104abea8a535550455220544553548a5350525445535400000089056bc75e2d63100000888ac7230489e800000a80801ba004f48705f54e0ca0c2ebc04730ec1e5589f073321d522c8fb3e7ab13b9fee599a03b84fc632bcfaa7930bdb9f489ee478d0cf9526e75ca29c0c03ea9aa116d3e06';

    /**
     * Test to decode data for MinterCreateCoinTx
     */
    public function testDecode(): void
    {
        $tx = new MinterTx(self::VALID_SIGNATURE);

        $this->assertSame($tx->data, self::DATA);
        $this->assertSame($tx->from, self::MINTER_ADDRESS);
    }

    /**
     * Test signing MinterCreateCoinTx
     */
    public function testSign(): void
    {
        $tx = new MinterTx([
            'nonce' => 1,
            'gasPrice' => 1,
            'type' => MinterCreateCoinTx::TYPE,
            'data' => self::DATA,
            'payload' => '',
            'serviceData' => ''
        ]);

        $signature = $tx->sign(self::PRIVATE_KEY);

        $this->assertSame($signature, self::VALID_SIGNATURE);
    }
}
