General Notes:

What is the difference between when to use an abstract class versus an interface?
- Behaviors are good for interfaces

Composition was mind blowing.  An object that has a property that is a separate object but then you pass in the entire object (including the property that references the sub-object).  How does this not result in an infinite loop?

When designing classes I should think about responsibility.

WARNING: When cloning objects if the cloned object has properties that are objects they are cloned by reference.  If this behavior needs to change you need to implement the `__clone()` method.

Singleton's are common with the factory pattern to pass flags for concrete object creation.

Duplicate conditionals are a code smell sign that we should implement polymorphism.

Favor composition over inheritance

Simplicity is achieved by ensuring that all classes are derived from a common base (relates to composition).

Caching for large tree structures is necessary and may require children have references to their parents.

Composites don't work well with relational databases because it could need many expensive queries.

Composites are not the only type of composition

Traits

Polymorphism

instanceof
