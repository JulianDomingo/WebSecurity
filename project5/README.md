# Project 5 - Encryption

Time spent: **X** hours spent in total

## User Stories

The following **required** functionality is completed:

1. Symmetric Encrypt/Decrypt
  * [X]  Required: Repair the symmetric encrypt and decrypt code

2. Encrypted Message 1
  * [X]  Required: Decrypt the government message
  * [X]  Required: Encrypt a response and include in this README
    Response: 2gZV7w5BcfoB5kLxG6nFibmzd8N5U/VHY+FHUe/oj+kes+gU3j/ywn170EsKFpyVTWK/QZp40nI8/O2vKFhvPw==
    (Apex HQ received the message late last night, a Wednesday.)

3. Generate Public-Private Keys
  * [X]  Required: Repair the key generator code
  * [X]  Required: Generate keys for "johnsteed" and add him to the Agent Directory

4. Asymmetric Encrypt/Decrypt
  * [X]  Required: Repair the asymmetric encrypt and decrypt code

5. Create/Verify Signature
  * [X]  Required: Repair the create and verify signature code
  
6. Encrypted Message 2
  * [X]  Required: Decrypt the message
  * [X]  Required: Verify the message
  * [X]  Required: Include a response message in this README
    Response: 
    C6rHdFQge9cFWIx0SLaEDBEwhPjHRoHHRMiJ4dHQfg/jLDXVLfxvwakDwLPaSXgPHJ5B/slwQorJmPqcAfjOzZdiDYthtV256NSk7h0Wn4+Bo5tyN1IeIODpZ9btxceD4fITW52K8kqyJ1NizeusMhnvUMQdiUoazSO6COlQnGlxqBAZQQqaV1CgRLJPxSRrpskQ7a7aCoOSZuSNlbBHRGUsCEOTl3oygXh4RnEjkeS0xM62SxqCUkAlbDcXZIbbd1+htUscdMYbMD3RVhL14jnEbQXJFTt0nGMv+8ulJ1Vvy76bW+jMrbiY2yuSPNYWIdKzWuvo8gsWKLsr3tUeGw==

    Signature: 
    eUkGoE8ooZCpbAINETL46KfnhMpwga0GCFRse7Xnma1UhguSQFpCTJqlfRMn1RxYhw93X4LCIbu1jiQe05C3UvyW5Neug5yseo+TpQLRaIIiWpnNkhGBf/swxhY1x+Kl6qqBtUBUdDqOHx0teppop9TGu5SqTxINsc5iTRaD+NBfPjH0OzZIMTkzNMNmX+7UswzKFwnckIfgtWjEsMllhyXAlY8sneBMfgG+zz4TqxyDdSbzdYObs/0tFTHCrN3UM5TWHqjgyiS3kFDh9X8VjJ/gP05TjMYikrh8pT2TnvJeACuRCjcdLdZV1TlgFFEbfPAMO6qjaid5MLNluUKX5Q==

7. Agent Messages
  * [X]  Required: Repair the dropbox code
  * [X]  Required: Repair the messages area
  * [X]  Required: Display encrypted messages for all agents
  * [X]  Required: Messages indicate whether the message signature is valid
  * [X]  Required: Your messages are automatically decrypted

8. Identify the Double Agent
  * [X]  Required: Decrypt as many email messages as possible
  * [X]  Required: Identify the double agent: _______Natasha (Dark Shadow attempted to frame Austin)_____________

The following objectives are **optional**:

* Bonus Objective 1.
  * [X]  Track down the bugs in the code and fix them.

* Bonus Objective 2.
  * [X]  Write a report of your discoveries (longer than 300 characters).
  * [X]  Compose a secure email for sending over an insecure network.
  * [X]  Include the email with your encrypted report in this README.
  (Since asymmetric encryption using a 2048-bit RSA key is limited to a plaintext message of up to 245 bytes/characters, the report is encrypted using symmetric encryption, but with an asymmetrically encrypted password.)

  Encrypted report:
  UGzivRwDR9Y2vlQDIKhTc/XybU6B7cJzSy5e4uJO4/tHxRAHxb4UkKFMSUWvxXNKwMr1rcsZrV8MnVedbqNH3rUa8DH4Aw9RljyLmu0Cab0kJmbydVSaq3+UfMbgV0pUjvRmonTvgZjrL2Px4gwEkOkQzmbj8rEv6Xs4D7nskja1ukbkPqSQ8kaNP7Bg4vneGePbTL68+hHRjR7C6ELk81gdSUf/zIvYRHWDDIkGR7t9DFodMEQx9gtQFH+eCwbRYtN3c179vlkAtQziWZU+7u5MFMHvix6TydmsAw7CG8rezLnHehjvcmYy/OLDz78kyGMSBAOzlBQadmgaxPOSKJe+/QpfWHb3QunxlEfH8rawoSi9bUjUc49xE5k+oa8VZE+47ni1YK1qbQT6KnsQgRHP6l2/8GH64j0vDxQg0LZkgbRenNCHi5peluhZ7sgtVt05yr9QDodK0xGjuIMniWW77vR93kgX/Ak6GDrndPCBN3UH44dJCwZ2sLmbmw0xXI5jII+jHcnkTkQIBxBREaH9GxYS47Wqf71LhHQrNDdAwKvxlCSOoMJNBpWtOYVmGKzmDLaQSkjJ75VEitlIVWjdBAFUQAZEiewahBFqfJWBZ5udjsJzGjmeH+a7H+MOfQsoZjaPBsdVcnAT148vd4rDXcbPdz+y7Hm+Z7eVi8n/UagjzancxlQitm6gDwiib5DgG2WTgZO9L7qbRoBQGIPam7ZtQXsFq21T16XGeWL3MZ/z/teFBB8lIt99C4RZ445h89O7hNbevRranPXPZoVHfF4N77DgVLtJW4CjFkSkkrHyiPoHzHwQe7WCR7FfLxIwj5p2FOwpWiiAjGhI/w==

  Password:
  QTWMbfIV8A/CvRNCbcUOchh70eHAO8uyiIpQkiuoGCK8MHV35oiW+meN8DiPGfvER1HnxtGHdq1whQVvdGW/pkXTL0UAbIhSMzx+8UY1BoR+tqOKPiFy0/4+y22n+0P50BGPNgU65I336LTmRKX3xfq2ADGl/Dj/CEw7S8KIL3Tv1LG2/b6l6oDCcFWz7hPFVmYoUcRvBjme7Pfdx4AD48dfzgorWWnpQpxLlOvGyIylPpxS2tyy35Q3yoMRiUiWgEBTCV2rOr0RroCF8FpQBKWqfqic2yr4mVgEgDi8i4kfG0B5FUA/YQ81dBOp4++EZQcsPKlwLdCN+MbMB5E5tA==

  Signature:
  XcqwnTZwNtf+o5I3Yr5U0GDCrdu2ND+R9V6GYLvWXZOtcd9tz3Zj+Mn8gf6jtYWI0Q2Wbi+U0N2OKYA74VVWk2KGPwhOPsQsjUSshGgpBp786w8xNaV3HbyimNlRcB6hElS02TeTIbG3SKGZuILNxiiGSWBVHwmH0+sk1Rve5ZswzVgrFSNXMBJRy53vvvqlDfF+CIvEdOu4qRU5wOtRbXPgHPN+5Mqy8IaZwGzpgIQIcKQIQVM9KD6fn1TFdIg1PprBRr+qoCxyVwfUdC539wqumD8Bq8SbnO70NHhLEONBY5Vk5RT5PsGq37hDUqhcCTZhAv4Ju+4rgyyrxUxbIw==

* Bonus Objective 3.
  * [X]  Add a "Create/Verify Checksum" section to the Encryption Tools area.

* Advanced Objective 1.
  * [X]  Add support for other symmetric algorithms.

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='http://i.imgur.com/link/to/your/gif/file.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
