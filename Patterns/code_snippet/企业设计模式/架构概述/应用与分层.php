<?php

/**
 * 本章中的许多模式旨在促进应用中的不同分层独立工作。
 * 就像类代表职责的特化一样，
 * 企业系统的分层也是如此，只是职责更重大。
 *
 *        生成指向控制层的请求                          视图层
 *
 *        解释请求并查询业务逻辑层                      命令和控制层       获取结果并选择合适的视图
 *
 *        处理业务问题                                 业务逻辑层         返回结果给命令控制层
 *
 *        处理数据的获取与存储                         数据层
 *
 *
 * 上面的结构并不是一成不变的，其中的某些层可能会合并，
 * 而且各层间的交互策略可能会因系统的复杂度而不同。
 * 但不论怎么样，上面展示的模型具有很高的灵活性和可复用性，
 * 大多数企业应用在很大程度上都遵循这个模型。
 *
 * 视图层和命令控制层经常组合为一个表示层
 *
 *
 *
 *
 */
